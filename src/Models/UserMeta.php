<?php

namespace Cms\Models;



use Porteiro\Models\UserMeta as Model;
// use SierraTecnologia\Cashier\Billable; //@todo removi

class UserMeta extends Model
{
    // use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
        'is_active',
        'activation_token',
        'marketing',
        'sitecpayment_id',
        'card_brand',
        'card_last_four',
        'terms_and_cond',
    ];
    
    /**
     * Get all of the subscriptions for the business.
     */
    public function subscriptions()
    {
        return $this->hasMany('Cms\Models\Negocios\Subscription');
    }
}
