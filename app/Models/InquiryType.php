<?php

namespace App\Models;

use App\Models\domains\InquiryTypes\InquiryTypeEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class InquiryType extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'text' => 'like',
    ];

    protected $fillable = [
        'text',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create(InquiryTypeEntity $inquiryTypeEntity) {

        $entity = (new InquiryType())->fill([
            'text' => $inquiryTypeEntity->getText(),
        ]);

        $entity->save();

        return $entity;
    }
    
    public function put(InquiryTypeEntity $inquiryTypeEntity) {

        $entity = $this->fill([
            'text' => $inquiryTypeEntity->getText(),
        ]);

        $entity->save();

        return $entity;
    }
}
