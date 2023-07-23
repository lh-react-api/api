<?php

namespace App\Models;

use App\Models\domains\Delivers\DeliverEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Deliver extends BaseModel
{
    use HasFactory;

    protected $searches = [];

    protected $fillable = [
        'order_id',
        'deliver_time_id',
        'user_id',
        'last_name',
        'last_name_kana',
        'first_name',
        'first_name_kana',
        'post_number',
        'prefecture_name',
        'city',
        'block',
        'building',
        'phone_number',
        'email',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function create(DeliverEntity $deliver) {

        $entity = (new Deliver())->fill([
            'order_id' => $deliver->getOrderId(),
            'deliver_time_id' => $deliver->getDeliverTimeId(),
            'last_name' => $deliver->getFullNameEntity()->getLastName(),
            'last_name_kana' => $deliver->getFullNameEntity()->getLastNameKana(),
            'first_name' => $deliver->getFullNameEntity()->getFirstName(),
            'first_name_kana' => $deliver->getFullNameEntity()->getFirstNameKana(),
            'post_number' => $deliver->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $deliver->getAddressContentEntity()->getPrefectureName(),
            'city' => $deliver->getAddressContentEntity()->getCity(),
            'block' => $deliver->getAddressContentEntity()->getBlock(),
            'building' => $deliver->getAddressContentEntity()->getBuilding(),
            'phone_number' => $deliver->getPhoneNumber(),
            'email' => $deliver->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }

    public function updateEntity(DeliverEntity $deliver)
    {
        $entity = $this->fill([
            'order_id' => $deliver->getOrderId(),
            'deliver_time_id' => $deliver->getDeliverTimeId(),
            'last_name' => $deliver->getFullNameEntity()->getLastName(),
            'last_name_kana' => $deliver->getFullNameEntity()->getLastNameKana(),
            'first_name' => $deliver->getFullNameEntity()->getFirstName(),
            'first_name_kana' => $deliver->getFullNameEntity()->getFirstNameKana(),
            'post_number' => $deliver->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $deliver->getAddressContentEntity()->getPrefectureName(),
            'city' => $deliver->getAddressContentEntity()->getCity(),
            'block' => $deliver->getAddressContentEntity()->getBlock(),
            'building' => $deliver->getAddressContentEntity()->getBuilding(),
            'phone_number' => $deliver->getPhoneNumber(),
            'email' => $deliver->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }
}
