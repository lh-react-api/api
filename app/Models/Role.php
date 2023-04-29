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
        'name' => 'equal',
    ];

    protected $fillable = [
        'name',
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
        ]);

        $entity->save();

        return $entity;
    }

    public function updateEntity(RoleEntity $role)
    {
        $entity = $this->fill([
           'name' => $role->getName(),
        ]);
        $entity->save();   

        return $entity;
    }
}
