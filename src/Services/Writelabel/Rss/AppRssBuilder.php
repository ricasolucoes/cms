<?php

namespace Cms\Services\Rss;

use Cms\Models\Post;
use Cms\Services\Rss\Contracts\RssBuilder;
use Cms\Models\Contracts\PhotoManager;
use Population\Manipule\Entities\PostEntity;
use Population\Manipule\Entities\TagEntity;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use SiObjects\Mount\Rss\Category;
use SiObjects\Mount\Rss\Channel;
use SiObjects\Mount\Rss\Contracts\Builder;
use SiObjects\Mount\Rss\Enclosure;
use SiObjects\Mount\Rss\Item;
use function SiUtils\Helper\url_frontend;
use function SiUtils\Helper\url_frontend_photo;
use function SiUtils\Helper\url_storage;

/**
 * Class AppRssBuilder.
 *
 * @package Cms\Services\Rss
 */
class AppRssBuilder implements RssBuilder
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var Builder
     */
    private $rssBuilder;

    /**
     * @var PhotoManager
     */
    private $photoManager;

    /**
     * AppRssBuilder constructor.
     *
     * @param Config       $config
     * @param Storage      $storage
     * @param Builder      $rssBuilder
     * @param PhotoManager $photoManager
     */
    public function __construct(Config $config, Storage $storage, Builder $rssBuilder, PhotoManager $photoManager)
    {
        $this->config = $config;
        $this->storage = $storage;
        $this->rssBuilder = $rssBuilder;
        $this->photoManager = $photoManager;
    }

    /**
     * @inheritdoc
     */
    public function build(): Builder
    {
        return $this->rssBuilder
            ->setChannel($this->provideChannel())
            ->setItems($this->provideItems());
    }

    /**
     * Provide the RSS channel.
     *
     * @return Channel
     */
    private function provideChannel(): Channel
    {
        return (new Channel)
            ->setTitle($this->config->get('app.name'))
            ->setDescription($this->config->get('app.description'))
            ->setLink(url_frontend());
    }

    /**
     * Provide the RSS items.
     *
     * @return array
     */
    private function provideItems(): array
    {
        return (new Post)
            ->newQuery()
            ->withEntityRelations()
            ->whereIsPublished()
            ->orderByCreatedAtDesc()
            ->take(100)
            ->get()
            ->map(
                function (Post $post) {
                    return $post->toEntity();
                }
            )
            ->map(
                function (PostEntity $post) {
                    return (new Item)
                        ->setTitle($post->getDescription())
                        ->setDescription((string) $post->getPhoto()->getMetadata())
                        ->setLink(url_frontend_photo($post->getId()))
                        ->setGuid(url_frontend_photo($post->getId()))
                        ->setPubDate($post->getPhoto()->getCreatedAt()->toAtomString())
                        ->setEnclosure(
                            (new Enclosure)
                                ->setUrl(url_storage($this->storage->url($post->getPhoto()->getThumbnails()->first()->getPath())))
                                ->setType('image/jpeg')
                                ->setLength($this->storage->size($post->getPhoto()->getThumbnails()->first()->getPath()))
                        )
                        ->setCategories(
                            $post->getTags()
                                ->map(
                                    function (TagEntity $tag) {
                                        return (new Category)->setValue($tag->getValue());
                                    }
                                )
                            ->toArray()
                        );
                }
            )
            ->toArray();
    }
}
