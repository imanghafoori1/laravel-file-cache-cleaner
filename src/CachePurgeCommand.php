<?php

namespace Imanghafoori\CacheCleaner;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Symfony\Component\Finder\Finder;

class CachePurgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clean_files';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     */
    protected static $defaultName = 'cache:clean_files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the obsolete cached items in file system.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $config = config('cache');
        $store = $config['default'];

        $storeConfigs = $config['stores'][$store] ?? [];

        if (($storeConfigs['driver'] ?? '') !== 'file') {
            $this->info('Your store driver is not set to the "file" driver!');

            return;
        }

        $cacheFiles = Finder::create()->in($storeConfigs['path'])->files();

        try {
            foreach ($cacheFiles as $cacheFile) {
                $contents = $cacheFile->getContents();
                $expire = substr($contents, 0, 10);

                if (Carbon::now()->getTimestamp() >= $expire) {
                    $path = $cacheFile->getPath();
                    $deletedFile = $filesystem->delete($cacheFile->getPathname());

                    // deletes the parent directory
                    if ($deletedFile && $this->files(dirname($path)) === 0) {
                        $filesystem->deleteDirectory(dirname($path));
                    }
                }
            }
        } catch (\RuntimeException $e) {
            //
        }

        $this->info('Your Filesystem cache successfully purged!');
    }

    public function files($directory)
    {
        return Finder::create()->files()->ignoreDotFiles(true)->in($directory)->depth(1)->sortByName()->count();
    }
}
