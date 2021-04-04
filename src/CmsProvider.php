<?php

namespace Cms;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Muleta\Traits\Providers\ConsoleTools;
use Cms\Services\BusinessService;

class CmsProvider extends ServiceProvider
{
    use ConsoleTools;

    public $packageName = 'cms';
    const pathVendor = 'ricasolucoes/cms';

    public static $aliasProviders = [

    ];

    public static $providers = [
        \Cms\Providers\HomeServiceProvider::class,
        \Cms\Providers\FeatureServiceProvider::class,
        \Cms\Providers\RiCaServiceProvider::class,
        \Cms\Providers\CmsEventProvider::class,
        \Cms\Providers\CmsRouteProvider::class,
        \Cms\Providers\CmsModuleProvider::class,

        \Porteiro\PorteiroProvider::class,
        \Templeiro\TempleiroProvider::class,
        // \Bancario\BancarioProvider::class,
        // \Transmissor\TransmissorProvider::class,
        // \Integrations\IntegrationsProvider::class,
        // \Telefonica\TelefonicaProvider::class,
        
    ];

    /**
     * Rotas do Menu
     */
    public static $menuItens = [
        'Cms|510' => [
            [
                'text'        => 'Dash',
                'route'       => 'cms.sitec.dash',
                'icon'        => 'fas fa-fw fa-gavel',
                'icon_color'  => 'blue',
                'order' => 512,
                'label_color' => 'success',
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Profile',
                'route'       => 'cms.sitec.profile',
                'icon'        => 'fas fa-fw fa-gavel',
                'icon_color'  => 'blue',
                'order' => 514,
                'label_color' => 'success',
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Actors',
                'route'       => 'cms.components.actors.profile',
                'icon'        => 'fas fa-fw fa-gavel',
                'icon_color'  => 'blue',
                'order' => 518,
                'label_color' => 'success',
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
        ],
        'Painel|501' => [
            [
                'text' => 'User',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'order' => 550,
                'label_color' => "success",
            ],
            'User' => [
                [
                    'text'        => 'Home',
                    'url'       => '/',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'order' => 555,
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Profile',
                    'route'       => 'facilitador.profile',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'order' => 557,
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                // @todo Tirar Facilitador
                [
                    'text'        => 'Logout',
                    'route'       => 'facilitador.logout',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'order' => 559,
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
            ],
        ],
    ];

    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->publishes(
            [
            $this->getPublishesPath('app/Controllers') => app_path('Http/Controllers/Cms'),
            $this->getPublishesPath('app/Services') => app_path('Services'),
            ],
            ['app',  'sitec', 'sitec-app', 'cms', 'cms-app']
        );

        $this->publishes(
            [
            $this->getPublishesPath('config') => base_path('config'),
            ],
            ['config',  'sitec', 'sitec-config', 'cms', 'cms-config']
        );

        $this->publishes(
            [
            $this->getPublishesPath('routes') => base_path('routes'),
            ],
            ['routes',  'sitec', 'sitec-routes', 'cms', 'cms-routes']
        );

        $this->publishes(
            [
            $this->getPublishesPath('public/js') => base_path('public/js'),
            $this->getPublishesPath('public/css') => base_path('public/css'),
            $this->getPublishesPath('public/img') => base_path('public/img'),
            ],
            ['public',  'sitec', 'sitec-public', 'cms', 'cms-public']
        );

        $this->publishes(
            [
            $this->getPublishesPath('resources/tools') => base_path('resources/tools'),
            ],
            ['tools',  'sitec', 'sitec-tools', 'cms', 'cms-tools']
        );

        $this->publishes(
            [
            $this->getResourcesPath('views') => base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'cms'),
            ],
            ['views',  'sitec', 'sitec-views', 'cms', 'cms-views']
        );


        /**
         * Cms; Routes
         */
        $this->app->booted(
            function () {
                $this->routes();
            }
        );

        // @todo Isso é do Cms remover
        // Config::set(
        //     'connections.connections.system',
        //     [
        //         'driver' => env('TENANCY_CONNECTION', 'mysql'),
        //         'host' => env('TENANCY_HOST', 'db'),
        //         'port' => env('TENANCY_PORT', '3306'),
        //         'database' => env('TENANCY_DATABASE', 'rica'),
        //         'username' => env('TENANCY_USERNAME', 'root'),
        //         'password' => env('TENANCY_PASSWORD', 'A123456'),
        //         'unix_socket' => env('DB_SOCKET', ''),
        //         'charset' => 'utf8mb4',
        //         'collation' => 'utf8mb4_unicode_ci',
        //         'prefix' => '',
        //         'strict' => true,
        //         'engine' => null,
        //     ]
        // );
    }
    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }


        /**
         * Porteiro; Routes
         */
        $this->loadRoutesForRiCa(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'routes');
    }

    /**
     * Register the services.
     */
    public function register()
    {
        // Register external packages
        $this->setProviders();
        
        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');

        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'cms');
        $this->publishes(
            [
            $viewsPath => base_path('resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'cms'),
            ],
            'views'
        );

        if (is_dir(base_path('resources/cms'))) {
            $this->app->view->addNamespace('cms-frontend', base_path('resources/cms'));
        } else {
            $this->app->view->addNamespace('cms-frontend', $this->getResourcesPath('cms'));
        }


        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */
        // Register commands
        $this->registerCommandFolders(
            [
            base_path('vendor/ricasolucoes/cms/src/Console/Commands') => '\Cms\Console\Commands',
            ]
        );
    }
}
