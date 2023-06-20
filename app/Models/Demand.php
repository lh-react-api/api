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
        'name',
        'name_kana',
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

    public static function create(DemandEntity $deliver) {

        $entity = (new Demand())->fill([
            'order_id' => $deliver->getOrderId(),
            'name' => $deliver->getVersatilityUserEntity()->getName(),
            'name_kana' => $deliver->getVersatilityUserEntity()->getNameKana(),
            'post_number' => $deliver->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $deliver->getAddressContentEntity()->getPrefectureName(),
            'city' => $deliver->getAddressContentEntity()->getCity(),
            'block' => $deliver->getAddressContentEntity()->getBlock(),
            'building' => $deliver->getAddressContentEntity()->getBuilding(),
            'phone_number' => $deliver->getVersatilityUserEntity()->getPhoneNumber(),
            'email' => $deliver->getVersatilityUserEntity()->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }

    public function updateEntity(DemandEntity $deliver)
    {
        $entity = $this->fill([
            'order_id' => $deliver->getOrderId(),
            'name' => $deliver->getVersatilityUserEntity()->getName(),
            'name_kana' => $deliver->getVersatilityUserEntity()->getNameKana(),
            'post_number' => $deliver->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $deliver->getAddressContentEntity()->getPrefectureName(),
            'city' => $deliver->getAddressContentEntity()->getCity(),
            'block' => $deliver->getAddressContentEntity()->getBlock(),
            'building' => $deliver->getAddressContentEntity()->getBuilding(),
            'phone_number' => $deliver->getVersatilityUserEntity()->getPhoneNumber(),
            'email' => $deliver->getVersatilityUserEntity()->getEmail(),
        ]);

        $entity->save();

        return $entity;
    }
}
