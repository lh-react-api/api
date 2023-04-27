<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Genre extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'upper_id',
        'level',
        'information',
        'image',
    ];

    protected $searches = [
        'name' => 'like',
        'level' => 'eq',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        $query->orderBy('created_at', 'desc');
        return $query;
    }
}
