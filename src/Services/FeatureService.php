<?php

namespace Cms\Services;

use Cms\Models\Feature;
use Illuminate\Support\Facades\Schema;

class FeatureService
{
    public function __construct(Feature $model)
    {
        $this->model = $model;
    }

    /**
     * All features
     *
     * @return Collection
     */
    public function getByKey($code)
    {
        return $this->model->where('code', $code)->first();
    }
    public function getByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * All features
     *
     * @return Collection
     */
    public function isActive($code)
    {
        // VErifica se tem nas Configuracoes, se nao, ja cancela
        if (config('cms.active-core-features', false)) {
            if (!in_array($code, config('cms.active-core-features'))) {
                return false;
            }
        } else {
            if (!in_array($code, config('siravel.active-core-features'))) {
                return false;
            }
        }

        // VErifica se ta ativo no banco
        if (!$feature = $this->model->where('code', $code)->first()) {
            return false;
        }
        if (!$feature->is_active) {
            return false;
        }

        if (class_exists(\Cms\Services\BusinessService::class) && !app(\Cms\Services\BusinessService::class)->hasFeature($code)){
            return false;
        }

        return true;
    }

    /**
     * Paginated features
     *
     * @return PaginatedCollection
     */
    public function paginated()
    {
        return $this->model->orderBy('code', 'desc')->paginate(env('PAGINATE', 25));
    }

    /**
     * Search features
     *
     * @param  string  $input
     * @param  integer $id
     * @return Collection
     */
    public function search($input, $id)
    {
        $query = $this->model->orderBy('code', 'desc');
        $query->where('id', 'LIKE', '%'.$input.'%');

        $columns = Schema::getColumnListing('features');

        foreach ($columns as $attribute) {
            if (is_null($id)) {
                $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
            } else {
                $query->orWhere($attribute, 'LIKE', '%'.$input.'%')->where('user_id', $id);
            }
        };

        return $query->paginate(env('PAGINATE', 25));
    }

    /**
     * Create a notification
     *
     * @param  array $input
     * @return boolean|exception
     */
    public function create($payload)
    {
        try {
            if (isset($payload['is_active'])) {
                $payload['is_active'] = true;
            } else {
                $payload['is_active'] = false;
            }

            return $this->model->create($payload);
        } catch (Exception $e) {
            throw new Exception("Could save your feature, please try agian.", 1);
        }
    }

    /**
     * Find a notification
     *
     * @param  integer $id
     * @return Feature
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update a notification
     *
     * @param  integer $id
     * @param  array   $payload
     * @return Feature
     */
    public function update($id, $payload)
    {
        $feature = $this->model->find($id);

        if (isset($payload['is_active'])) {
            $payload['is_active'] = true;
        } else {
            $payload['is_active'] = false;
        }

        $feature->update($payload);

        return $feature;
    }

    /**
     * Destroy a Feature
     *
     * @param  integer $id
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
