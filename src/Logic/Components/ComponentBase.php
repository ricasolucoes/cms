<?php

namespace Cms\Logic\Components;

class ComponentBase
{

    /**
     * @return string[]
     *
     * @psalm-return array{0: Carrousel\Base::class, 1: Enquete\Base::class, 2: Form\Base::class}
     */
    public static function getComponents(): array
    {
        return [
            Carrousel\Base::class,
            Enquete\Base::class,
            Form\Base::class,
        ];
    }
}
