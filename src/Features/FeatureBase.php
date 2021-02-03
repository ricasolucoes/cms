<?php

namespace Cms\Features;

class FeatureBase
{

    public static function getFeatures()
    {
        return [
            Bancario\Base::class,
            Blog\Base::class,
            Casa\Base::class,
            Commerce\Base::class,
            Escritor\Base::class,
            Fa\Base::class,
            Finder\Base::class,
            Gamification\Base::class,
            Marketing\Base::class,
            Midias\Base::class,
            Productions\Base::class,
            Travels\Base::class,
            Writelabel\Base::class,
        ];
    }
}
