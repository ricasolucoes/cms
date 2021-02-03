<?php

namespace Cms\Listeners;

use Tenancy\Affects\Filesystems\Events\ConfigureDisk;

class ConfigureTenantDisk
{
    public function handle(ConfigureDisk $event)
    {
        $event->config = [
            'driver' => 'local',
            'root' => storage_path('app/' . $event->event->tenant->getTenantKey()),
        ];
    }
}
