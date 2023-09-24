<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Item extends BaseModel
{
    use HasFactory;
    protected $searches = [
        'name' => 'like',
    ];

    protected $fillable = [
        'name',
        'price',
        'content',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create($name, $price, $content) {

        $entity = (new Item())->fill([
            'name' => $name,
            'price' => $price,
            'content' => $content,
        ]);

        $entity->save();

        return $entity;
    }
    
    public function put($name, $price, $content) {

        $entity = $this->fill([
            'name' => $name,
            'price' => $price,
            'content' => $content,
        ]);

        $entity->save();

        return $entity;
    }
}
