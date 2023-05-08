<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Genre extends BaseModel
{
// MEMO: App\Models\closure_table\Genresを使うべし;
//
//    use HasFactory;
//
//    protected $fillable = [
//        'name',
//        'parent_id',
//        'position',
//        'information',
//        'image',
//    ];
//
//    protected $searches = [
//        'name' => 'like',
//        'position' => 'eq',
//    ];
//
//    public function scopeSearchIndex(Builder $query, Request $request): Builder
//    {
//        $query->searchByDefined($request);
//        $query->orderBy('created_at', 'desc');
//        return $query;
//    }
}
