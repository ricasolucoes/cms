<?php

namespace Cms\Models\Blog;

use Cms\Models\CmsModel;
use Cms\Services\Normalizer;
use Translation\Traits\HasTranslations;
use Informate\Models\System\Archive;
use Muleta\Traits\Models\ArchiveTrait;

class Blog extends CmsModel
{
    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $translatable = ['title'];

    protected $guarded = [];

    public $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    public function getEntryAttribute($value): Normalizer
    {
        return new Normalizer($value);
    }
}
