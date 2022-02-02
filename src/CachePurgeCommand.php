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
    protected $signature = 'cache:clean_files {store? : The name of the store}';

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
        $store = $this->argument('store') ?: $config['default'];

        if (! isset($config['stores'][$store])) {
            $this->warn('The storage: "'.$store.'" does not exists in config file.');

            return;
        }

        $storeConfigs = $config['stores'][$store] ?? [];

        if (($storeConfigs['driver'] ?? '') !== 'file') {
            $this->warn('Your store driver is not set to the "file" driver!');

            return;
        }

        $cacheFiles = Finder::create()->in($storeConfigs['path'])->files();
        $size = $count = 0;
        $now = Carbon::now()->getTimestamp();

        try {
            foreach ($cacheFiles as $cacheFile) {
                // For more safety, to prevent accidental deletion of other files
                // we check the length of the file names to be 40 chars long.
                if (strlen($cacheFile->getFilename()) !== 40) {
                    continue;
                }

                $expire = file_get_contents($cacheFile->getPathname(), false, null, 0, 10);

                if (! is_numeric($expire)) {
                    continue;
                }

                if ($now >= (int) $expire) {
                    $size += $cacheFile->getSize() / 1000;
                    $filesystem->delete($cacheFile->getPathname()) && $count++;
                }
            }
        } catch (\ErrorException $e) {
            //
        } catch (\RuntimeException $e) {
            //
        }

        $this->info('- Your filesystem cache successfully purged!');
        $this->info('- '.$count. ' files ('.$size.' kb) where deleted. \(^_^)/');
    }

    public function files($directory)
    {
        return Finder::create()->files()->ignoreDotFiles(true)->in($directory)->depth(1)->sortByName()->count();
    }
}
