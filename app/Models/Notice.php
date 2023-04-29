<?php

namespace App\Models;

use App\Models\domains\Notices\NoticeEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Notice extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'division' => 'equal',
        'title' => 'like',
        'text' => 'like',
    ];

    protected $fillable = [
        'division',
        'title',
        'text',
        'notice_date',
        'close_date',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create(NoticeEntity $NoticeEntity) {
        $entity = (new Notice())->fill([
            'division' => $NoticeEntity->getDivision(),
            'title' => $NoticeEntity->getTitle(),
            'text' => $NoticeEntity->getText(),
            'notice_date' => $NoticeEntity->getNoticeDate(),
            'close_date' => $NoticeEntity->getCloseDate(),
        ]);
        $entity->save();

        return $entity;
    }
    
    public function updateEntity(NoticeEntity $NoticeEntity) {
        $entity = $this->fill([
            'division' => $NoticeEntity->getDivision(),
            'title' => $NoticeEntity->getTitle(),
            'text' => $NoticeEntity->getText(),
            'notice_date' => $NoticeEntity->getNoticeDate(),
            'close_date' => $NoticeEntity->getCloseDate(),
        ]);

        $entity->save();

        return $entity;
    }
}
