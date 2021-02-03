<?php

namespace Cms\Repositories;

use Carbon\Carbon;
use Cms\Models\Negocios\Faq;
use Cms\Repositories\CmsRepository;
use Translation\Repositories\ModelTranslationRepository;

class FaqRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Faq $model, ModelTranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = 'faqs';
    }

    /**
     * Stores Faq into database.
     *
     * @param array $payload
     *
     * @return Faq
     */
    public function store($payload)
    {
        $payload['question'] = htmlentities($payload['question']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

        return $this->model->create($payload);
    }

    /**
     * Updates Faq into database.
     *
     * @param Faq   $Faq
     * @param array $input
     *
     * @return Faq
     */
    public function update($item, $payload)
    {
        $payload['question'] = htmlentities($payload['question']);

        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('siravel.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($item->id, 'Cms\Models\Negocios\Faq', $payload['lang'], $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $item->update($payload);
        }
    }
}
