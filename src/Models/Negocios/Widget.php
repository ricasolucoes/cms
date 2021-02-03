<?php

namespace Cms\Models\Negocios;

use App\Models\Model;
use function key_exists;

use Translation\Traits\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Widget
 *
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Widget extends Model
{
    use SoftDeletes;

    use HasTranslations;

    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    public $translatable = [
        'name',
        'content',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}