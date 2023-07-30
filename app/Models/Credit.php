<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Enums\Credits\CreditsStatus;
use App\Models\Stripe\StripePaymentMethod;
use App\Models\domains\Stripe\MaskCardEntity;
use Stripe\PaymentMethod;

class Credit extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payments_source',
        'status',
    ];
    protected $appends = [
        'detail',
    ];

    public static function createForWebhook(string $paymentsSource, string $customerId)
    {
        $user = User::findByStripeCustomerId($customerId);
        $entity = (new Credit())->fill([
            'user_id' => $user->id,
            'payments_source' => $paymentsSource,
            'status' => CreditsStatus::ENABLE,
        ]);

        $entity->save();
    }

    public static function getCardList()
    {   
        $userId = Auth::user()->id;
        $creditCards = self::query()->where('user_id', $userId)
                                   ->where('status', CreditsStatus::ENABLE)->get();
        $paymentMethods = $creditCards->map(function ($card){
            $stripe = new StripePaymentMethod();
            $stripe->setMyCustomerId();    
            return $stripe->getRetrievePaymentMethod($card->payments_source);
        });
        return $paymentMethods->map(function ($paymentMethod){
            return new MaskCardEntity(
                $paymentMethod->id,
                $paymentMethod->card->brand,
                $paymentMethod->card->cvc_check,
                $paymentMethod->card->exp_month,
                $paymentMethod->card->exp_year,
                $paymentMethod->card->last4,
            );
        });
    }

    public static function searchForUserId(string $userId): Credit{
        return Credit::query()->where('user_id', '=', $userId)->first();
    }
}
