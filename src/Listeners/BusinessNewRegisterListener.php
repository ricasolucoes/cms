<?php

namespace Cms\Listeners;

use Business;
use Facilitador\Models\Notification;
use Cms\Events\BusinessNewRegister;
use Cms\Services\BusinessService;

class BusinessNewRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BusinessNewRegister $event
     * @return void
     */
    public function handle(BusinessNewRegister $event)
    {
        Notification::generate(
            Business::getBusiness()->id,
            '',
            [
                'id' => $event->userMeta->id >= 5000,
                'name' => $event->userMeta->user->name >= 5000
            ]
        );
    }
}
