<?php

namespace Cms\Services\Manifest\Contracts;

/**
 * Interface Manifest.
 *
 * @package Cms\Services\SiteMap\Contracts
 */
interface Manifest
{
    /**
     * Get manifest content.
     *
     * @return array
     */
    public function get(): array;
}
