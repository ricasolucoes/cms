<?php

namespace Cms\Models\Negocios;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function key_exists;


/**
 * Class Contact
 *
 * @package App\Models
 * @version December 18, 2016, 5:33 am UTC
 */
class Contact extends Model
{
    use SoftDeletes;

    public $table = 'contact';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'contactcol',
        'email_id',
        'service_id',
        'clients_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'contactcol' => 'string',
        'email_id' => 'integer',
        'service_id' => 'integer',
        'clients_id' => 'integer',
        'description' => 'string'
    ];

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
    public function clients()
    {
        return $this->belongsTo(\App\Models\Clients::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function email()
    {
        return $this->belongsTo(\App\Models\Email::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }

    /**
     * Recupera parametros da snowevo para o formulario de contato
     *
     * @return array
     */
    public static function getContactItens()
    {
        $boolOptions = [
            'sim' => Lang::get('contact.sim'),
            'nao' => Lang::get('contact.nao'),
        ];
        $destinos = [
            'Pirineus - '.Lang::get('snowevo.andorra'),
            'Pirineus - '.Lang::get('snowevo.franca'),
            'Pirineus - '.Lang::get('snowevo.catalunya'),
            'Alpes - '.Lang::get('snowevo.franca'),
            'Alpes - '.Lang::get('snowevo.suica'),
        ];
        $quartos = self::getQuartos();
        $numPeoples = [
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6 ou mais' => '6 '.Lang::get('contact.ou').' + ',
        ];
        // $numPeoples = [
        //     'adulto' => Lang::get('contact.numPeoplesAdulto'),
        //     'junior' => Lang::get('contact.numPeoplesJunior'),
        //     'infantiladulto' => Lang::get('contact.numPeoplesInfantilAdulto'),
        //     'infantil' => Lang::get('contact.numPeoplesInfantil'),
        //     'senior' => Lang::get('contact.numPeoplesSenior'),
        // ];
        $fazerAulasSeSim = [
            'vez' => Lang::get('contact.fazerAulaVez'),
            'iniciado' => Lang::get('contact.fazerAulaIniciado'),
            'medio' => Lang::get('contact.fazerAulaMedio'),
            'avancado' => Lang::get('contact.fazerAulaAvancado'),
        ];

        return [
            $boolOptions,
            $destinos,
            $quartos,
            $numPeoples,
            $fazerAulasSeSim
        ];
    }

    protected static function getQuartos()
    {
        $quartos = [
            Lang::get('contact.hotels') => [
                1 => Lang::get('contact.hotelsSingle'),
                2 => Lang::get('contact.hotelsDuplo'),
                3 => Lang::get('contact.hotelsTriplo'),
                4 => Lang::get('contact.hotelsQuadruplo'),
            ],
            Lang::get('contact.apartaments') => [
                5 => Lang::get('contact.estudio'),
                6 => '1 '.Lang::get('contact.quartos'),
                7 => '2 '.Lang::get('contact.quartos'),
                8 => '3 '.Lang::get('contact.quartos'),
            ],
            Lang::get('contact.chalets') => [
                9 => '2 '.Lang::get('contact.quartos'),
                10 => '3 '.Lang::get('contact.quartos'),
                11 => '4 '.Lang::get('contact.quartos'),
                12 => '5 '.Lang::get('contact.ou').' + '.Lang::get('contact.quartos'),
            ]
        ];

        return $quartos;
    }
    public static function getQuartosByIndex($index)
    {
        $quartos = self::getQuartos();

        foreach ($quartos as $groupName => $tipoquarto) {
            if (key_exists($index, $tipoquarto)) {
                return $groupName.' - '.$tipoquarto[$index];
            }
        }

        return Lang::get('contact.notExist');
    }
}
