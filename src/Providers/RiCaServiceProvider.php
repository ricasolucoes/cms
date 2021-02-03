<?php

namespace Cms\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Cms\Services\BlogService;
use Cms\Services\EventService;
use Cms\Services\ModuleService;
use Cms\Services\Negocios\PageService;

class RiCaServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('PageService', \Cms\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \Cms\Facades\EventServiceFacade::class);
        $loader->alias('ModuleService', \Cms\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Cms\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \MediaManager\Services\FileService::class);


        $this->app->bind(
            'PageService', function ($app) {
                return new PageService();
            }
        );

        $this->app->bind(
            'EventService', function ($app) {
                return App::make(EventService::class);
            }
        );

        $this->app->bind(
            'ModuleService', function ($app) {
                return new ModuleService();
            }
        );

        $this->app->bind(
            'BlogService', function ($app) {
                return new BlogService();
            }
        );
    }
}
