<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Enums\Credits\CreditsBrand;
use App\Enums\Credits\CreditsStatus;
use Stripe\Event;

class Credit extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payments_source',
        'brand',
        'cvc_check',
        'exp_month',
        'exp_year',
        'last4',
        'status',
    ];

    protected $appends = [
        'brandLabel',
    ];

    public static function createForWebhook(Event $event)
    {
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $brand = $event->data->object->card->brand;
        if (!in_array($brand, CreditsBrand::toArray())) {
            $brand = CreditsBrand::UNKNOWN;
        }
        $entity = (new Credit())->fill([
            'user_id' => $user->id,
            'payments_source' => $event->data->object->id,
            'brand' => $event->data->object->card->brand,
            'cvc_check' => $event->data->object->card->checks->cvc_check,
            'exp_month' => sprintf('%02d', $event->data->object->card->exp_month),
            'exp_year' => $event->data->object->card->exp_year,
            'last4' => $event->data->object->card->last4,
            'status' => CreditsStatus::ENABLE,
        ]);

        $entity->save();
    }

    public function updateStatus(CreditsStatus $status)
    {
        $this->status = $status;
        $this->save();
    }

    public static function getCardList()
    {
        $userId = Auth::user()->id;
        return self::query()->where('user_id', $userId)
                            ->where('status', CreditsStatus::ENABLE)->get();
    }

    public static function searchForUserId(string $userId): Credit{
        return Credit::query()->where('user_id', '=', $userId)->first();
    }

    public function getBrandLabelAttribute($value)
    {
        return $this->enumLabel($this->brand, "App\Enums\Credits\CreditsBrand");
    }
}
