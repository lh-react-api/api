<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    use HasFactory;

    protected $appends = [
        'progressLabel',
    ];

    public function getProgressLabelAttribute($value)
    {
        return $this->enumLabel($this->progress, "App\Enums\Orders\OrdersProgress");

    }

}
