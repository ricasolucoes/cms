<?php

namespace Cms\Models\Blog;

use App\Contants\Tables;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Cms\Builders\PostBuilder;
use Cms\Contracts\Business\BusinessTrait;
use Cms\Entities\PostEntity;

use Cms\Models\CmsModel as BaseModel;

/**
 * Class Post.
 *
 * @property int id
 * @property int created_by_user_id
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon published_at
 * @property bool is_published
 * @property User createdByUser
 * @property Collection photos
 * @property Photo photo
 * @property Collection tags
 * @package  Cms\Models
 */
class Post extends BaseModel
{
    use BusinessTrait;

    public static $classeBuilder = PostBuilder::class;

    const PUBLISHED = 'PUBLISHED';

    /**
     * @inheritdoc
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'created_by_user_id',
        'description',
        'is_published',
    ];

    /**
     * @inheritdoc
     */
    protected $attributes = [
        'description' => '',
    ];

    /**
     * @var array
     */
    public static $entityRelations = [
        'tags',
        'photos',
        'photos.location',
        'photos.thumbnails',
    ];

    protected $translatable = ['description'];
    
    /**
     * @inheritdoc
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(
            function (self $post) {
                $post->tags()->detach();
                $post->photos()->detach();
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): PostBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, Tables::TABLE_POSTS_PHOTOS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * @return Photo|null
     */
    public function getPhotoAttribute(): ?Photo
    {
        $this->setRelation('photo', collect($this->photos)->first());

        $photo = $this->getRelation('photo');

        return $photo;
    }

    /**
     * @param  bool $isPublished
     * @return $this
     */
    public function setIsPublishedAttribute(bool $isPublished)
    {
        if ($this->is_published !== $isPublished) {
            $this->attributes['published_at'] = $isPublished ? Carbon::now() : null;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPublishedAttribute(): bool
    {
        $isPublished = false;

        if (isset($this->attributes['published_at'])) {
            $isPublished = (bool) $this->attributes['published_at'];
        }

        return $isPublished;
    }

    /**
     * @return $this
     */
    public function loadEntityRelations(): Post
    {
        return $this->load(static::$entityRelations);
    }

    /**
     * @return PostEntity
     */
    public function toEntity(): PostEntity
    {
        return new PostEntity(
            [
            'id' => $this->id,
            'created_by_user_id' => $this->created_by_user_id,
            'description' => $this->description,
            'photo' => $this->photo->toArray(),
            'tags' => $this->tags->toArray(),
            'created_at' => $this->created_at->toAtomString(),
            'updated_at' => $this->updated_at->toAtomString(),
            'published_at' => $this->published_at ? $this->published_at->toAtomString() : null,
            ]
        );
    }

    public function scopePublished(PostBuilder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }
}

// /**
//  * From Facilitador @todo
//  */

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Auth;
// use Facilitador\Facades\Facilitador;
// use Facilitador\Traits\Resizable;
// use Translation\Traits\HasTranslations;

// class Post extends Model
// {
//     use HasTranslations,
//         Resizable;

//     protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

//     const PUBLISHED = 'PUBLISHED';

//     protected $guarded = [];

//     public function save(array $options = [])
//     {
//         // If no author has been assigned, assign the current user's id as the author of the post
//         if (!$this->author_id && Auth::user()) {
//             $this->author_id = Auth::user()->getKey();
//         }

//         parent::save();
//     }

//     public function authorId()
//     {
//         return $this->belongsTo(Facilitador::modelClass('User'), 'author_id', 'id');
//     }

//     /**
//      * Scope a query to only published scopes.
//      *
//      * @param \Illuminate\Database\Eloquent\Builder $query
//      *
//      * @return \Illuminate\Database\Eloquent\Builder
//      */
//     public function scopePublished(Builder $query)
//     {
//         return $query->where('status', '=', static::PUBLISHED);
//     }

//     /**
//      * @return \Illuminate\Database\Eloquent\Relations\HasOne
//      */
//     public function category()
//     {
//         return $this->belongsTo(Facilitador::modelClass('Category'));
//     }
// }