<?php

namespace Cms\Repositories;

use Cms\Models\Negocios\Promotion;
use Cms\Repositories\CmsRepository;
use Translation\Repositories\ModelTranslationRepository;

class PromotionRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Promotion $model, ModelTranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = \Illuminate\Support\Facades\Config::get('siravel.db-prefix').'promotions';
    }

    /**
     * Stores Promotions into database.
     *
     * @param array $payload
     *
     * @return Promotions
     */
    public function store($payload)
    {
        $payload['slug'] = str_slug($payload['slug']);

        return $this->model->create($payload);
    }

    /**
     * Updates Promotion in the database
     *
     * @param Promotions $widget
     * @param array      $payload
     *
     * @return Promotions
     */
    public function update($widget, $payload)
    {
        $payload['slug'] = str_slug($payload['slug']);

        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('siravel.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($widget->id, 'Cms\Models\Negocios\Promotion', $payload['lang'], $payload);
        } else {
            unset($payload['lang']);

            return $widget->update($payload);
        }
    }
}
