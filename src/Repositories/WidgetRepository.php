<?php

namespace Cms\Repositories;

use Cms\Models\Negocios\Widget;
use Cms\Repositories\CmsRepository;
use Translation\Repositories\ModelTranslationRepository;

class WidgetRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Widget $model, ModelTranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = \Illuminate\Support\Facades\Config::get('siravel.db-prefix').'widgets';
    }

    /**
     * Stores Widgets into database.
     *
     * @param array $payload
     *
     * @return Widgets
     */
    public function store($payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        return $this->model->create($payload);
    }

    /**
     * Updates Widget in the database
     *
     * @param Widgets $widget
     * @param array   $payload
     *
     * @return Widgets
     */
    public function update($widget, $payload)
    {
        $payload['name'] = htmlentities($payload['name']);

        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('siravel.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($widget->id, 'Cms\Models\Negocios\Widget', $payload['lang'], $payload);
        } else {
            unset($payload['lang']);

            return $widget->update($payload);
        }
    }
}
