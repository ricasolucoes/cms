<?php

namespace Cms\Logic\Widgets;

class WidgetBase
{

    /**
     * @return string[]
     *
     * @psalm-return array{0: Autoatendimento\Base::class, 1: TrackingVisitant\Base::class}
     */
    public static function getWidgets(): array
    {
        return [
            Autoatendimento\Base::class,
            TrackingVisitant\Base::class,
        ];
    }
}
