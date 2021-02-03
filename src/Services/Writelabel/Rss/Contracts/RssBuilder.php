<?php

namespace Cms\Services\Rss\Contracts;

use SiObjects\Mount\Rss\Contracts\Builder;

/**
 * Interface RssBuilder.
 *
 * @package Cms\Services\Rss\Contracts
 */
interface RssBuilder
{
    /**
     * Build the RSS feed.
     *
     * @return Builder
     */
    public function build(): Builder;
}
