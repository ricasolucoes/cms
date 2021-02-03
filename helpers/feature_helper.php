<?php

/*
 * --------------------------------------------------------------------------
 * Helpers for Features
 * --------------------------------------------------------------------------
*/

if (!function_exists('feature')) {
    function feature($key)
    {
        return app(Cms\Services\FeatureService::class)->isActive($key);
    }
}