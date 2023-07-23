<?php

namespace App\Models;

use App\Models\domains\Addresses\AddressEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_name',
        'last_name_kana',
        'first_name',
        'first_name_kana',
        'last_name',
        'post_number',
        'prefecture_name',
        'city',
        'block',
        'building',
        'phone_number',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];
    public static function create(AddressEntity $address): Address
    {

        $entity = (new Address)->fill([
            'user_id' => $address->getUserId(),
            'last_name' => $address->getFullName()->getLastName(),
            'last_name_kana' => $address->getFullName()->getLastNameKana(),
            'first_name' => $address->getFullName()->getFirstName(),
            'first_name_kana' => $address->getFullName()->getFirstNameKana(),
            'post_number' => $address->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $address->getAddressContentEntity()->getPrefectureName(),
            'city' => $address->getAddressContentEntity()->getCity(),
            'block' => $address->getAddressContentEntity()->getBlock(),
            'building' => $address->getAddressContentEntity()->getBuilding(),
            'phone_number' => $address->getPhoneNumberEntity(),
            'is_default' => false,
        ]);

        $entity->save();

        return $entity;
    }

    public function put(AddressEntity $address): Address
    {

        $entity = $this->fill([
            'last_name' => $address->getFullName()->getLastName(),
            'last_name_kana' => $address->getFullName()->getLastNameKana(),
            'first_name' => $address->getFullName()->getFirstName(),
            'first_name_kana' => $address->getFullName()->getFirstNameKana(),
            'post_number' => $address->getAddressContentEntity()->getPostNumber(),
            'prefecture_name' => $address->getAddressContentEntity()->getPrefectureName(),
            'city' => $address->getAddressContentEntity()->getCity(),
            'block' => $address->getAddressContentEntity()->getBlock(),
            'building' => $address->getAddressContentEntity()->getBuilding(),
            'phone_number' => $address->getPhoneNumberEntity(),
            'is_default' => false,
        ]);

        $entity->save();

        return $entity;
    }
}
