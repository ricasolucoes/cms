<?php

namespace Cms\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CmsEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Cms\Models\Blog' => [
            'Cms\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Cms\Models\Negocios\Page' => [
            'Cms\Models\Negocios\Page@afterSaved',
        ],
        'eloquent.saved: Cms\Models\Event' => [
            'Cms\Models\Event@afterSaved',
        ],
        'eloquent.saved: Cms\Models\FAQ' => [
            'Cms\Models\FAQ@afterSaved',
        ],
        'eloquent.saved: Cms\Models\Translation' => [
            'Cms\Models\Translation@afterSaved',
        ],
        'eloquent.saved: Cms\Models\Widget' => [
            'Cms\Models\Widget@afterSaved',
        ],

        'eloquent.created: Cms\Models\Blog' => [
            'Cms\Models\Blog@afterCreate',
        ],
        'eloquent.created: Cms\Models\Negocios\Page' => [
            'Cms\Models\Negocios\Page@afterCreate',
        ],
        'eloquent.created: Cms\Models\Event' => [
            'Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: Cms\Models\FAQ' => [
            'Cms\Models\Event@afterCreate',
        ],
        'eloquent.created: Cms\Models\Widget' => [
            'Cms\Models\Widget@afterCreate',
        ],
        'eloquent.created: Cms\Models\Link' => [
            'Cms\Models\Link@afterCreate',
        ],

        'eloquent.deleting: Cms\Models\Blog' => [
            'Cms\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Cms\Models\Negocios\Page' => [
            'Cms\Models\Negocios\Page@beingDeleted',
        ],
        'eloquent.deleting: Cms\Models\Event' => [
            'Cms\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Cms\Models\FAQ' => [
            'Cms\Models\FAQ@beingDeleted',
        ],
        'eloquent.deleting: Cms\Models\Translation' => [
            'Cms\Models\Translation@beingDeleted',
        ],
        'eloquent.deleting: Cms\Models\Widget' => [
            'Cms\Models\Widget@beingDeleted',
        ],
    ];

    // /**
    //  * Determine if events and listeners should be automatically discovered.
    //  *
    //  * @return bool
    //  */
    // public function shouldDiscoverEvents()
    // {
    //     return true;
    // }


    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot()
    {
        parent::boot();
    }
}
