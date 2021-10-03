<?php

namespace Cms\Services;

class ModuleService
{
    public function menus(): string
    {
        $modulePath = base_path(config('siravel.module-directory').'/');
        $features = glob($modulePath.'*');

        $menu = '';

        foreach ($features as $module) {
            if (is_dir($module)) {
                $module = lcfirst(str_replace($modulePath, '', $module));
                if (file_exists($modulePath.ucfirst($module).'/Views/menu.blade.php')) {
                    $menu .= view('features.menu');
                }
            }
        }

        if (is_array(config('siravel.features'))) {
            foreach (config('siravel.features') as $module => $config) {
                if (!is_dir($modulePath.ucfirst($module))) {
                    $menu .= view('features.menu');
                }
            }
        }

        return $menu;
    }
}
