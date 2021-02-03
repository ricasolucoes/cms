<?php

namespace Cms\Models;

use Pedreiro\Models\Base;
use Muleta\Traits\Models\ComplexRelationamentTrait;

class Feature extends Base
{
    public $table = "features";

    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string'; 

    // public $timestamps = false;

    public $fillable = [
        'name',
        'code',
        'key',
        'is_active',
    ];

    public $rules = [
        'key' => 'required',
    ];
    

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name',
    //     'code'
    // ];

    // protected $mappingProperties = array(
    //     /**
    //      * User Info
    //      */
    //     'name' => [
    //         'type' => 'string',
    //         "analyzer" => "standard",
    //     ],
    //     'cpf' => [
    //         'type' => 'string',
    //         "analyzer" => "standard",
    //     ],
    //     'email' => [
    //         'type' => 'string',
    //         "analyzer" => "standard",
    //     ],

    //     /**
    //      * Grupo de Usuário:
    //      * 
    //      * 3 -> Usuário de Produtora
    //      * Default: 3
    //      */
    //     'role_id' => [
    //         'type' => 'string',
    //         "analyzer" => "standard",
    //     ],
    // );

    /**
     * Get all of the business that are assigned this tag.
     */
    public function business()
    {
        return $this->businesses();
    }

    /**
     * Get all of the businesses that are assigned this item.
     */
    public function businesses()
    {
        return $this->morphedByMany('Cms\Models\Negocios\Business', 'featureable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'featureable');
    }
}
