<?php

namespace Cms\Services;

use Illuminate\Support\Facades\Config;

class BlogService
{
    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    public function getTemplatesAsOptions(): array
    {
        $availableTemplates = ['show'];
        $templates = glob(base_path('resources/themes/'.Config::get('siravel.frontend-theme').'/blog/*'));

        foreach ($templates as $template) {
            $template = str_replace(base_path('resources/themes/'.Config::get('siravel.frontend-theme').'/blog/'), '', $template);
            if (stristr($template, 'template')) {
                $template = str_replace('-template.blade.php', '', $template);
                if (!stristr($template, '.php')) {
                    $availableTemplates[] = $template.'-template';
                }
            }
        }

        return $availableTemplates;
    }
}
