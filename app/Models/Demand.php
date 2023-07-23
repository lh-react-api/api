<?php

namespace App\Models;

use App\Models\domains\Demands\DemandEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Demand extends BaseModel
{
    use HasFactory;

    protected $searches = [];

    protected $fillable = [
        'order_id',
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

    public static function create(DemandEntity $demand) {

        $entity = (new Demand())->fill([
            'order_id' => $demand->getOrderId(),
            'last_name' => $demand->getFullNameEntity()->getLastName(),
            'last_name_kana' => $demand->getFullNameEntity()->getLastNameKana(),
            'first_name' => $demand->getFullNameEntity()->getFirstName(),
            'first_name_kana' => $demand->getFullNameEntity()->getFirstNameKana(),
            'post_number' => $demand->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $demand->getAddressContentEntity()->getPrefectureName(),
            'city' => $demand->getAddressContentEntity()->getCity(),
            'block' => $demand->getAddressContentEntity()->getBlock(),
            'building' => $demand->getAddressContentEntity()->getBuilding(),
            'phone_number' => $demand->getPhoneNumber(),
            'email' => $demand->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }

    public function updateEntity(DemandEntity $demand)
    {
        $entity = $this->fill([
            'order_id' => $demand->getOrderId(),
            'last_name' => $demand->getFullNameEntity()->getLastName(),
            'last_name_kana' => $demand->getFullNameEntity()->getLastNameKana(),
            'first_name' => $demand->getFullNameEntity()->getFirstName(),
            'first_name_kana' => $demand->getFullNameEntity()->getFirstNameKana(),
            'post_number' => $demand->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $demand->getAddressContentEntity()->getPrefectureName(),
            'city' => $demand->getAddressContentEntity()->getCity(),
            'block' => $demand->getAddressContentEntity()->getBlock(),
            'building' => $demand->getAddressContentEntity()->getBuilding(),
            'phone_number' => $demand->getPhoneNumber(),
            'email' => $demand->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }
}
