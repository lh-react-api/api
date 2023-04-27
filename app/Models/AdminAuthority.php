<?php

namespace App\Models;

use App\Models\domains\AdminAuthorities\AdminAuthorityEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminAuthority extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'user_id' => 'equal',
        'role_id' => 'equal',
    ];

    protected $fillable = [
        'user_id',
        'role_id',
        'action',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }   

    public static function findForShow(int $id){
        return self::find($id);
    }
   
    public static function findAdminAuthority(int $userId, int $roleId){
        return AdminAuthority::query()->with(['user', 'role'])
                                      ->where('user_id', '=', $userId)
                                      ->where('role_id', '=', $roleId)
                                      ->get();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }


    public static function create(AdminAuthorityEntity $adminAuthority) {

        $entity = (new AdminAuthority())->fill([
            'user_id' => $adminAuthority->getUserId(),
            'role_id' => $adminAuthority->getRoleId(),
            'action' => $adminAuthority->getAction(),
        ]);

        $entity->save();

        return $entity;
    }

    public static function updateEntity(AdminAuthority $adminAuthority, AdminAuthorityEntity $inputAdminAuthority) {
        $adminAuthority->user_id = $inputAdminAuthority->getUserId();
        $adminAuthority->role_id = $inputAdminAuthority->getRoleId();
        $adminAuthority->action = $inputAdminAuthority->getAction();
        $adminAuthority->save();
        return $adminAuthority;
    }
}
