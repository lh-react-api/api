<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use APP\Models\domains\Credits\CreditEntity;

class Credit extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_customer_id',
    ];
    protected $appends = [
        'detail',
    ];

    public static function create(CreditEntity $credit)
    {

        $entity = (new Credit())->fill([
            'user_id' => $credit->getUserId(),
            'stripe_customer_id' => $credit->getStripeCustmerId(),
        ]);

        $entity->save();
    }

    public static function getCardList()
    {   
        $stripe = new Stripe();
        $stripe->setMyCustomerId();
        return $stripe->getCustmerCardlist();
    }

    public static function searchForUserId(string $userId): Credit{
        return Credit::query()->where('user_id', '=', $userId)->first();
    }
}
