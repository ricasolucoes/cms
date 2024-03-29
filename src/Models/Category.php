<?php

namespace Facilitador\Models;

use Illuminate\Database\Eloquent\Model;
use Facilitador\Facades\Facilitador;
use Translation\Traits\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasTranslations;

    protected $table = 'categories';

    protected $translatable = ['slug', 'name'];

    protected $fillable = ['slug', 'name'];

    protected $dates = ['deleted_at'];

    protected $guarded  = array('id');
    

    public function parentId(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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
     * Get the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the slider's images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'article_category_id');
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

    /**
     * Get the category's language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_code');
    }
}
