<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/signin', \App\Http\Controllers\Auth\Signin::class);
Route::post('auth/signup', \App\Http\Controllers\Auth\Signup::class);
Route::get('users/{email}/password/reissue', \App\Http\Controllers\Users\ReissuePassword::class);
Route::patch('users/{email_reissue_token}/password/reissue', \App\Http\Controllers\Users\UpdateByReissuePassword::class);

//Route::post('auth/sanctum/session/signin', \App\Http\Controllers\Auth\SanctumSessionSignin::class);
//Route::post('auth/sanctum/token/signin', \App\Http\Controllers\Auth\SanctumTokenSignin::class);

Route::group(['middleware' => [
    'auth:sanctum',
    'transaction',
    'formatRequestParam'
]], function () {

    // Auth
    Route::post('auth/signout', \App\Http\Controllers\Auth\Signout::class);
//    Route::post('auth/sanctum/session/signout', \App\Http\Controllers\Auth\SanctumSessionSignout::class);
//    Route::post('auth/sanctum/token/signout', \App\Http\Controllers\Auth\SanctumTokenSignout::class);

    // My
    Route::get('my/user', \App\Http\Controllers\My\User\Show::class);
    Route::patch('my/user/email', \App\Http\Controllers\My\User\UpdateEmail::class);
    Route::patch('my/user/password', \App\Http\Controllers\My\User\UpdatePassword::class);
    Route::delete('my/user/withdrawal', \App\Http\Controllers\My\User\UpdateStatusWithdrawal::class);

    Route::get('my/addresses', \App\Http\Controllers\My\Addresses\Index::class);

    Route::get('my/address/default', \App\Http\Controllers\My\Address\_Default::class);
    Route::patch('/my/address/isDefault', \App\Http\Controllers\My\Address\UpdateIsDefault::class);

//    Route::post('auth/sanctum/session/signout', \App\Http\Controllers\Auth\SanctumSessionSignout::class);
//    Route::post('auth/sanctum/token/signout', \App\Http\Controllers\Auth\SanctumTokenSignout::class);

    // Users
    Route::get('users', \App\Http\Controllers\Users\Index::class);
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);

    // Addresses
    Route::post('addresses', \App\Http\Controllers\Addresses\Store::class);
    Route::put('addresses/{address_id}', \App\Http\Controllers\Addresses\Update::class);

    Route::delete('addresses/{address_id}', \App\Http\Controllers\Addresses\Delete::class);


    // Genres
    Route::get('genres', \App\Http\Controllers\Genres\index::class);


    // ProductOrigin
    Route::get('productOrigins', \App\Http\Controllers\ProductOrigins\index::class);
    Route::get('productOrigins/{product_origin_id}', \App\Http\Controllers\ProductOrigins\Show::class);

    // UpdateIsDefaultByUserId

    /**
     * 管理系API群
     */

    /**
     * 管理者権限
     * AdminAuthority
     */
    Route::get('admin/adminAuthorities', \App\Http\Controllers\Admin\AdminAuthorities\index::class);
    Route::get('admin/adminAuthorities/{admin_authority_id}', \App\Http\Controllers\Admin\AdminAuthorities\Show::class);
    Route::post('admin/adminAuthorities', \App\Http\Controllers\Admin\AdminAuthorities\Store::class);
    Route::put('admin/adminAuthorities/{admin_authority_id}', \App\Http\Controllers\Admin\AdminAuthorities\Update::class);
    Route::delete('admin/adminAuthorities/{admin_authority_id}', \App\Http\Controllers\Admin\AdminAuthorities\Delete::class);
    /**
     * 管理者権限マスタ
     * Roles
     */
    Route::get('admin/roles', \App\Http\Controllers\Admin\Roles\index::class);
    Route::get('admin/roles/{roles_id}', \App\Http\Controllers\Admin\Roles\Show::class);
    Route::post('admin/roles', \App\Http\Controllers\Admin\Roles\Store::class);
    Route::put('admin/roles/{roles_id}', \App\Http\Controllers\Admin\Roles\Update::class);
    Route::delete('admin/roles/{roles_id}', \App\Http\Controllers\Admin\Roles\Delete::class);
});