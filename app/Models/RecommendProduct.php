<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class RecommendProduct extends BaseModel
{
    use HasFactory;

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->orderBy('created_at', 'desc');
        return $query;
    }
}
