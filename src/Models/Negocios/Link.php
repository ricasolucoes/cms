<?php

namespace Cms\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;

use Translation\Traits\HasTranslations;

/**
 * Class Link
 *
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Link extends Model
{
    use HasTranslations;
    use SoftDeletes;

    public $table = 'links';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'external_url',
        'slug',
        'page_id',
        'menu_id',
    ];
    protected $translatable = ['name'];

    /**
     * Validation rules
     *
     * @var array
     */
    public $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function links()
    {
        return $this->belongsTo(\Cms\Models\Negocios\Link::class);
    }
}
