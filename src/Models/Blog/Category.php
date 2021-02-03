<?php

namespace Cms\Models\Blog;

use Cms\Models\Model;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;
use Facilitador\Facades\Facilitador;
use Translation\Traits\HasTranslations;

class Category extends Model
{
    use SoftDeletes;
    use HasTranslations;

    protected $table = 'categories';

    protected $translatable = ['slug', 'title'];

    protected $fillable = ['slug', 'title'];

    protected $dates = ['deleted_at'];

    protected $guarded  = array('id');
    

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }


    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function description()
    {
        return nl2br($this->description);
    }

    /**
     * Get the slider's images.
     *
     * @return array
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    /**
     * Get the slider's images.
     *
     * @return array
     */
    public function posts()
    {
        return $this->hasMany(Facilitador::modelClass('Post'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }
}
