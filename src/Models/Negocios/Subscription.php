<?php

namespace Cms\Models\Negocios;

use Cms\Builders\SubscriptionBuilder;
use Cms\Entities\SubscriptionEntity;
use App\Models\Model;

/**
 * Class Subscription.
 *
 * @property int id
 * @property string email
 * @property string token
 * @package  App\Models
 */
class Subscription extends Model
{

    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'email',
    ];

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): SubscriptionBuilder
    {
        return new SubscriptionBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): SubscriptionBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return SubscriptionEntity
     */
    public function toEntity(): SubscriptionEntity
    {
        return new SubscriptionEntity(
            [
            'id' => $this->id,
            'email' => $this->email,
            'token' => $this->token,
            ]
        );
    }
}
