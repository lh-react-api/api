<?php

namespace App\Models;

use App\Models\domains\DeliverTimes\DeliverTimeEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class DeliverTime extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'deliver_time' => 'like',
        'deadline' => 'like',
    ];

    protected $fillable = [
        'deliver_time',
        'order',
        'deadline',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->orderBy('order', 'asc');
        return $query;
    }


    public static function findForShow(int $id){
        return self::find($id);
    }
    
    public static function create(DeliverTimeEntity $deliverTimeEntity) {

        $entity = (new DeliverTime())->fill([
            'deliver_time' => $deliverTimeEntity->getDeliverTime(),
            'order' => $deliverTimeEntity->getOrder(),
            'deadline' => $deliverTimeEntity->getDeadline(),
        ]);

        $entity->save();

        return $entity;
    }

    public function put(DeliverTimeEntity $deliverTimeEntity )
     {
        $entity = $this->fill([
            'deliver_time' => $deliverTimeEntity->getDeliverTime(),
            'order' => $deliverTimeEntity->getOrder(),
            'deadline' => $deliverTimeEntity->getDeadline(),
        ]);

         $entity->save();

         return $entity;
     }
}
