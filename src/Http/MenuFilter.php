<?php

namespace Cms\Http;

use Pedreiro\Http\MenuFilter as MenuFilterBase;
use Log;

// use Laratrust;

class MenuFilter extends MenuFilterBase
{
    public function transform($item)
    {
        // dd(app(\Cms\Services\BusinessService::class));
        // if (!$this->verifyFeature($item)) {
        //     Log::debug('Feature Desativada: '.$item['feature']. ' -> Menu: '.$item['text']);
        //     return false;
        // }
        return parent::transform($item); // $item; //
    }

    private function verifyFeature($item)
    {
        $feature = null;
        if (isset($item['feature'])) {
            $feature = $item['feature'];
        }

        if (empty($feature)) {
            return true;
        }

        return \Features::isActive($feature);
    }
}
