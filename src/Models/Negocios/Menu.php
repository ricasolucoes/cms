<?php

namespace Cms\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Support\Events\MenuDisplay;


/**
 * Class Menu
 *
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getOrderAttribute($value)
    {
        if (is_null($value)) {
            return '[]';
        }

        return $value;
    }

    public static function boot()
    {
        parent::boot();

        static::saved(
            function ($model) {
                $model->removeMenuFromCache();
            }
        );

        static::deleted(
            function ($model) {
                $model->removeMenuFromCache();
            }
        );
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function parent_items()
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id');
    }

    /**
     * Display menu.
     *
     * @param string      $menuName
     * @param string|null $type
     * @param array       $options
     *
     * @return string
     */
    public static function display($menuName, $type = null, array $options = [])
    {
        // GET THE MENU - sort collection in blade
        $menu = \Cache::remember(
            'facilitador_menu_'.$menuName, \Carbon\Carbon::now()->addDays(30), function () use ($menuName) {
                return static::where('name', '=', $menuName)
                    ->with(
                        ['parent_items.children' => function ($q) {
                            $q->orderBy('order');
                        }]
                    )
                ->first();
            }
        );

        // Check for Menu Existence
        if (!isset($menu)) {
            return false;
        }

        event(new MenuDisplay($menu));

        // Convert options array into object
        $options = (object) $options;

        $items = $menu->parent_items->sortBy('order');

        if ($menuName == 'admin' && $type == '_json') {
            $items = static::processItems($items);
        }

        if ($type == 'admin') {
            $type = 'facilitador::menu.'.$type;
        } else {
            if (is_null($type)) {
                $type = 'facilitador::menu.default';
            } elseif ($type == 'bootstrap' && !view()->exists($type)) {
                $type = 'facilitador::menu.bootstrap';
            }
        }

        if (!isset($options->locale)) {
            $options->locale = app()->getLocale();
        }

        if ($type === '_json') {
            return $items;
        }


        return new \Illuminate\Support\HtmlString(
            \Illuminate\Support\Facades\View::make($type, ['items' => $items, 'options' => $options])->render()
        );
    }

    public function removeMenuFromCache()
    {
        \Cache::forget('facilitador_menu_'.$this->name);
    }

    private static function processItems($items)
    {
        $items = $items->transform(
            function ($item) {
                // Translate title
                $item->title = $item->getTranslatedAttribute('title');
                // Resolve URL/Route
                $item->href = $item->link(true);

                if ($item->href == url()->current() && $item->href != '') {
                    // The current URL is exactly the URL of the menu-item
                    $item->active = true;
                } elseif (Str::startsWith(url()->current(), Str::finish($item->href, '/'))) {
                    // The current URL is "below" the menu-item URL. For example "admin/posts/1/edit" => "admin/posts"
                    $item->active = true;
                }
                if (($item->href == url('') || $item->href == route('rica.dashboard')) && $item->children->count() > 0) {
                    // Exclude sub-menus
                    $item->active = false;
                } elseif ($item->href == route('rica.dashboard') && url()->current() != route('rica.dashboard')) {
                    // Exclude dashboard
                    $item->active = false;
                }

                if ($item->children->count() > 0) {
                    $item->setRelation('children', static::processItems($item->children));

                    if (!$item->children->where('active', true)->isEmpty()) {
                        $item->active = true;
                    }
                }

                return $item;
            }
        );

        // Filter items by permission
        $items = $items->filter(
            function ($item) {
                return !$item->children->isEmpty() || (Auth::user() && Auth::user()->can('browse', $item));
            }
        )->filter(
            function ($item) {
                // Filter out empty menu-items
                if ($item->url == '' && $item->route == '' && $item->children->count() == 0) {
                    return false;
                }

                return true;
            }
        );

        return $items->values();
    }
}