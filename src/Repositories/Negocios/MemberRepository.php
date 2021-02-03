<?php

namespace Cms\Repositories\Negocios;

use Cms;
use Config;
use Crypto;
use Cms\Models\UserMeta;
use Illuminate\Support\Facades\Schema;
use Cms\Repositories\CmsRepository as BaseRepository;
use Translation\Repositories\ModelTranslationRepository;

class MemberRepository extends BaseRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(UserMeta $model, ModelTranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->table = \Illuminate\Support\Facades\Config::get('siravel.db-prefix').'user_metas';
        $this->translationRepo = $translationRepo;
    }

    /**
     * Stores Members into database.
     *
     * @param array $payload
     *
     * @return Members
     */
    public function store($payload)
    {
        $payload['external'] = isset($payload['external']) ? $payload['external'] : 0;

        if ($payload['external'] != 0 && empty($payload['external_url'])) {
            throw new Exception("Your link was missing a URL", 1);
        }

        if (!isset($payload['page_id'])) {
            $payload['page_id'] = 0;
        }

        if ($payload['page_id'] == 0 && $payload['external'] == 0) {
            throw new Exception("Your link was not connected to anything, and could not be made", 1);
        }

        $link = $this->model->create($payload);

        $order = json_decode($link->menu->order);
        array_push($order, $link->id);
        $link->menu->update(
            [
            'order' => json_encode($order),
            ]
        );

        return $link;
    }

    /**
     * Updates Members into database.
     *
     * @param Member $link
     * @param array  $input
     *
     * @return Member
     */
    public function update($link, $payload)
    {
        $payload['external'] = isset($payload['external']) ? $payload['external'] : 0;

        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('siravel.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($link->id, 'Cms\Models\Negocios\Member', $payload['lang'], $payload);
        }

        unset($payload['lang']);

        return $link->update($payload);
    }
}