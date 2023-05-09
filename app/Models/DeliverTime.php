<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class DeliverTime extends BaseModel
{
    use HasFactory;

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
//        $query->searchByDefined($request);
        $query->orderBy('order', 'asc');
        return $query;
    }
}
