<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Cms\Models\Negocios\Link;
use Informate\Models\System\Archive;
use Translation\Models\Translation;
use Translation\Traits\HasTranslations;

class CmsModel extends Model
{
    use HasTranslations;

    public function getBlocksAttribute($value)
    {
        $blocks = json_decode($value, true);

        if (is_null($blocks)) {
            $blocks = [];
        }

        return $blocks;
    }


    /**
     * Model contructuor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!empty(config('siravel.db-prefix', ''))) {
            $this->table = config('siravel.db-prefix', '').$this->table;
        }
    }

    /**
     * After the item is saved to the database.
     *
     * @param object $payload
     */
    public function onSaved($payload)
    {
        if (!request()->is('admin/revert/*') && !request()->is('admin/rollback/*/*')) {
            unset($payload->attributes['created_at']);
            unset($payload->attributes['updated_at']);
            unset($payload->original['created_at']);
            unset($payload->original['updated_at']);

            if ($payload->attributes != $payload->original) {
                Archive::create(
                    [
                    'token' => md5(time()),
                    'entity_id' => $payload->attributes['id'],
                    'entity_type' => get_class($payload),
                    'entity_data' => json_encode($payload->attributes),
                    ]
                );
                Log::info(get_class($payload).' #'.$payload->attributes['id'].' was archived');
            }
        }
    }

    /**
     * When the item is being deleted.
     *
     * @param object $payload
     */
    public function onDeleting($payload)
    {
        $type = get_class($payload);
        $id = $payload->id;

        // @todo ta no translation
        Translation::where('entity_id', $id)->where('entity_type', $type)->delete();
        Archive::where('entity_id', $id)->where('entity_type', $type)->delete();

        Archive::where('entity_type', 'Translation\Models\Translation')
            ->where('entity_data', 'LIKE', '%"entity_id":'.$id.'%')
            ->where('entity_data', 'LIKE', '%"entity_type":"'.$type.'"%')
            ->delete();

        if ($type == 'Cms\Models\Negocios\Page') {
            Link::where('page_id', $id)->delete();
        }
    }
    
    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }

    /**
     * A method for getting / setting blocks
     *
     * @param  string $slug
     * @return string
     */
    public function block($slug)
    {
        $block = $this->findABlock($slug);

        if (!$block) {
            $this->update(
                [
                'blocks' => json_encode(array_merge($this->blocks, [ $slug => '' ]))
                ]
            );
        }

        return $block;
    }

    /**
     * Find a block based on slug
     *
     * @param  string $slug
     * @return string
     */
    public function findABlock($slug)
    {
        if (isset($this->blocks[$slug])) {
            return $this->blocks[$slug];
        }

        return false;
    }
}
