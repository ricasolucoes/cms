<?php

namespace Cms\Http\Resources;

use Cms\Models\Entities\SubscriptionEntity;
use Illuminate\Http\Resources\Json\Resource;
use function SiUtils\html_purify;
use function SiUtils\to_string;

/**
 * Class SubscriptionPlainResource.
 *
 * @package Cms\Http\Resources
 */
class SubscriptionPlainResource extends Resource
{
    /**
     * @var SubscriptionEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'email' => to_string(html_purify($this->resource->getEmail())),
            'token' => to_string(html_purify($this->resource->getToken())),
        ];
    }
}
