<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $appends = [
        'detail',
    ];

    public function getDetailAttribute($value)
    {
        // TODO: ここでAPI叩く
        return [
            'company' => 'カード会社',
            'ander_number' => '下４桁',
            'ttl' => '有効期限',
            'availability' => '利用可否',
        ];
    }
}
