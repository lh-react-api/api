<?php

namespace App\Models;

use App\Exceptions\DatabaseErrorException;
use App\Exceptions\NotUploadException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Cart extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function findByUserId(int $userId){
        return self::where('user_id',$userId)->get();
    }


    public static function updateByUserId($userId, $collection) {

        $carts = self::findByUserId($userId);
        $collection->map(function ($value) use($carts, $userId) {
            $row = $carts->where('item_id', $value['item_id']);

            if ($value['quantity'] === 0) {
                if (!$row->isEmpty()) {
                    $entity = $row->first();
                    $entity->delete();
                }
                return;
            }

            if (!$row->isEmpty()) {
                $entity = $row->first();
                $entity->quantity = $value['quantity'];
                $entity->save();
                return;
            }

            $entity = (new Cart())->fill($value);
            $entity->user_id = $userId;
            $entity->save();
        });
        return self::findByUserId($userId);
    }

}
