<?php

namespace Cms\Http;

use Pedreiro\Http\MenuFilter as MenuFilterBase;
use Log;

// use Laratrust;

class MenuFilter extends MenuFilterBase
{
    /**
     * @return array|false
     */
    public function transform($item)
    {
        if (!$this->verifyFeature($item)) {
            Log::debug('Feature Desativada: '.$item['feature']. ' -> Menu: '.$item['text']);
            return false;
        }
        return parent::transform($item); // $item; //
    }

    private function verifyFeature(array $item)
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
