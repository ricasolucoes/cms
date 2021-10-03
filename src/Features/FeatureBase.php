<?php

namespace Cms\Features;

class FeatureBase
{

    /**
     * @return string[]
     *
     * @psalm-return array{0: Bancario\Base::class, 1: Blog\Base::class, 2: Casa\Base::class, 3: Commerce\Base::class, 4: Escritor\Base::class, 5: Fa\Base::class, 6: Finder\Base::class, 7: Gamification\Base::class, 8: Marketing\Base::class, 9: Midias\Base::class, 10: Productions\Base::class, 11: Travels\Base::class, 12: Writelabel\Base::class}
     */
    public static function getFeatures(): array
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
