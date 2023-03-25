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

    // Users
    Route::get('users', \App\Http\Controllers\Users\index::class);
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::get('users/{user_id}', \App\Http\Controllers\Users\Show::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::patch('users/{user_id}/email', \App\Http\Controllers\Users\UpdateEmail::class);
    Route::patch('users/{user_id}/password', \App\Http\Controllers\Users\UpdatePassword::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);
    Route::delete('users/{user_id}/withdrawal', \App\Http\Controllers\Users\UpdateStatusWithdrawal::class);

    // Addresses
    Route::post('addresses', \App\Http\Controllers\Addresses\Store::class);
    Route::patch('users/{user_id}/addresses/isDefault', \App\Http\Controllers\Addresses\UpdateIsDefaultByUserId::class);

    // ProductOrigin
    Route::get('productOrigins', \App\Http\Controllers\ProductOrigins\index::class);

    // UpdateIsDefaultByUserId
});