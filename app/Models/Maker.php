<?php

namespace App\Models;

use App\Models\domains\makers\makerEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Maker extends BaseModel
{
    use HasFactory;
    protected $searches = [
        'name' => 'like',
    ];

    protected $fillable = [
        'name',
        'information',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create(makerEntity $maker) {

        $entity = (new maker())->fill([
            'name' => $maker->getName(),
            'information' => $maker->getInfomation(),
        ]);

        $entity->save();

        return $entity;
    }
    
    public function put(makerEntity $maker) {

        $entity = $this->fill([
            'name' => $maker->getName(),
            'information' => $maker->getInfomation(),
        ]);

        $entity->save();

        return $entity;
    }
}
