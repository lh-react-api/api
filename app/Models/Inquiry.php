<?php

namespace App\Models;

use App\Models\domains\Inquiries\InquiryEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Inquiry extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'inquiry_type_id' => 'eq',
    ];

    protected $fillable = [
        'inquiry_type_id',
        'email',
        'text',
        'status',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create(InquiryEntity $inquiryEntity) {

        $entity = (new Inquiry())->fill([
            'inquiry_type_id' => $inquiryEntity->getInquiryTypeId(),
            'email' => $inquiryEntity->getEmail(),
            'text' => $inquiryEntity->getText(),
            'status' => $inquiryEntity->getStatus(),
        ]);

        $entity->save();

        return $entity;
    }
    
    public function put(InquiryEntity $inquiryEntity) {

        $entity = $this->fill([
            'inquiry_type_id' => $inquiryEntity->getInquiryTypeId(),
            'email' => $inquiryEntity->getEmail(),
            'text' => $inquiryEntity->getText(),
            'status' => $inquiryEntity->getStatus(),
        ]);

        $entity->save();

        return $entity;
    }
}
