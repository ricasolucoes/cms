<?php

namespace Cms\Http\Resources;

use Cms\Models\Entities\LocationEntity;
use Illuminate\Http\Resources\Json\JsonResource as Resource;
use function SiUtils\html_purify;
use function SiUtils\to_float;

/**
 * Class LocationPlainResource.
 *
 * @package Cms\Http\Resources
 */
class LocationPlainResource extends Resource
{
    /**
     * @var LocationEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'latitude' => to_float(html_purify($this->resource->getCoordinates()->getLatitude())),
            'longitude' => to_float(html_purify($this->resource->getCoordinates()->getLongitude())),
        ];
    }
}
