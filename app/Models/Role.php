<?php

namespace App\Models;

use App\Models\domains\Roles\RoleEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Role extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'name' => 'eq',
        'ja_name' => 'like',
    ];

    protected $fillable = [
        'name',
        'ja_name',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function findNameForId(string $name){
        return Role::query()->where('name', '=', $name)->get();
    }
    
    public static function create(RoleEntity $roles) {

        $entity = (new Role())->fill([
            'name' => $roles->getName(),
            'ja_name' => $roles->getJaName(),
        ]);

        $entity->save();

        return $entity;
    }

    public function put(RoleEntity $role)
    {
        $entity = $this->fill([
           'name' => $role->getName(),
           'ja_name' => $role->getJaName(),
        ]);
        $entity->save();

        return $entity;
    }
}
