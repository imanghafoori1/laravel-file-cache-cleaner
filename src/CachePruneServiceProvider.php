<?php

namespace Imanghafoori\CacheCleaner;

use Illuminate\Support\ServiceProvider;

class CachePruneServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('command.file.cache.cleaner', function () {
            return new CachePurgeCommand();
        });
    }

    public function boot()
    {
        $this->commands('command.file.cache.cleaner');
    }
}
