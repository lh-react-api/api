<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Notice extends BaseModel
{
    use HasFactory;

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('notice_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('close_date', '>=', Carbon::now()->format('Y-m-d'));
    }
}
