<?php

namespace Cms\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Exception;

class ApiController extends AppBaseController
{
    public $model;

    public function __construct(Request $request)
    {
        parent::__construct();

        $url = $request->segment(3) ?? 'page';

        $this->modelName = str_singular($url);

        if (! empty($this->modelName) && $feature = $this->getFeature($this->module)) {
            // if (class_exists('App\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName))) {
            //     $this->model = app('App\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName));
            // } else 
            // if (class_exists('Cms\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName))) {
            //     $this->model = app('Siravel\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName));
            // } else 
            // if (class_exists('Siravel\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName))) {
            //     $this->model = app('Siravel\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName));
            // } else {
            //     throw new Exception("Modelo não existe para Api: ".'App\Models\\'.$this->getFeature($this->modelName).'\\'.ucfirst($this->modelName)."!");
            // }

            if (class_exists($feature['model'])) {
                $this->model = app($feature['model']);
            } else 
            if (class_exists('App\Models\\'.ucfirst($this->modelName))) {
                $this->model = app('App\Models\\'.ucfirst($this->modelName));
            } else 
            if (class_exists('Cms\Models\\'.ucfirst($this->modelName))) {
                $this->model = app('Siravel\Models\\'.ucfirst($this->modelName));
            } else 
            if (class_exists('Siravel\Models\\'.ucfirst($this->modelName))) {
                $this->model = app('Siravel\Models\\'.ucfirst($this->modelName));
            } else {
                throw new Exception("Modelo não existe para Api: ".'App\Models\\'.ucfirst($this->modelName)."!");
            }
        }
    }

    /**
     * Find an item in the API
     *
     * @param int $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Collect all items of a resource
     *
     * @return Collection
     */
    public function all()
    {
        $query = $this->model;

        if (Schema::hasColumn(str_plural($this->modelName), 'is_published')) {
            $query = $query->where('is_published', true);
        }

        if (Schema::hasColumn(str_plural($this->modelName), 'published_at')) {
            $query = $query->where('published_at', '<=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'));
        }

        if (Schema::hasColumn(str_plural($this->modelName), 'finished_at')) {
            $query = $query->where('finished_at', '>=', Carbon::now(config('app.timezone'))->format('Y-m-d H:i:s'));
        }

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(Config::get('siravel.pagination', 24));
    }

    /**
     * Search for the API Item
     *
     * @param string $term
     *
     * @return array
     */
    public function search($term)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing(str_plural($this->modelName));

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [
            'term' => $input['term'],
            'result' => $query->paginate(Config::get('siravel.pagination', 24)),
        ];
    }
}
