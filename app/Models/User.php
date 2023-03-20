<?php

namespace App\Models;

use App\Enums\Orders\OrdersProgress;
use App\Enums\Users\UsersStatus;
use App\Models\domains\Users\Credential;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'email',
        'password',
        'social',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    protected $searches = [
        'email' => 'like',
        'social' => 'in',
    ];

    protected $appends = [
        'statusLabel',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function defaultAddresses()
    {
        return $this->hasOne(Address::class)->where('is_default', true);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function activeOrders()
    {
        return $this->hasMany(Order::class)
            ->where('orders.progress', '!=', OrdersProgress::CLOSE);
    }

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function adminAuthorities()
    {
        return $this->hasMany(AdminAuthority::class);
    }

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        $query->orderBy('created_at', 'desc');
        return $query;
    }

    public static function findForShow(int $id){
        return self::with([
            'addresses',
            'defaultAddresses',
            'credits',
        ])->find($id);
    }

    public static function create(Credential $credential) {

        $entity = (new User)->fill([
            'email' => $credential->getEmail(),
            'password' => Hash::make($credential->getPassword()),
        ]);

        $entity->save();
    }

    public function updatePassword($password) {

        $this->password = Hash::make($password);
        $this->save();
    }


    public static function findByEmail($email){
        return self::query()->where('email', $email)->first();
    }

    public function getStatusLabelAttribute($value)
    {
        return $this->enumLabel($this->status, "App\Enums\Users\UsersStatus");

    }

    public static function findByEmailReissueToken($emailReissueToken){
        return self::query()->where('email_reissue_token', $emailReissueToken)->first();
    }
}
