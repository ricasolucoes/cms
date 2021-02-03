<?php

namespace Cms\Services\SiteMap\Contracts;

use SiObjects\Mount\SiteMap\Contracts\Builder;

/**
 * Interface SiteMapBuilderService.
 *
 * @package Cms\Services\SiteMap\Contracts
 */
interface SiteMapBuilder
{
    /**
     * Build the sitemap.
     *
     * @return Builder
     */
    public function build(): Builder;
}
