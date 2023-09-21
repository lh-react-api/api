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

/**
 * 認証関連（ミドルウェアなし）
 */
Route::post('auth/signin', \App\Http\Controllers\Auth\Signin::class);
Route::post('auth/signup', \App\Http\Controllers\Auth\Signup::class);

/**
 * パスワード変更関連
 */
Route::get('users/{email}/password/reissue', \App\Http\Controllers\Users\ReissuePassword::class);
Route::patch('users/{email_reissue_token}/password/reissue', \App\Http\Controllers\Users\UpdateByReissuePassword::class);

/**
 * ミドルウェア適用
 * auth:sanctum → Laravel Sanctumパッケージを利用するAPI認証ミドルウェア
 * transaction → DBトランザクション処理用のミドルウェア
 * formatRequestParam → リクエストパラメータのフォーマッターミドルウェア
 */
Route::group(['middleware' => [
    'auth:sanctum',
    'transaction',
    'formatRequestParam'
]], function () {

    /**
     * 認証関連
     * Auth
     */
    Route::post('auth/signout', \App\Http\Controllers\Auth\Signout::class);

    /**  ログイン中ユーザー用のAPI群  */
    /**
     * ユーザー
     * Users
     */
    Route::get('my/user', \App\Http\Controllers\My\User\Show::class);
    Route::patch('my/user/email', \App\Http\Controllers\My\User\UpdateEmail::class);
    Route::patch('my/user/password', \App\Http\Controllers\My\User\UpdatePassword::class);
    Route::delete('my/user/withdrawal', \App\Http\Controllers\My\User\UpdateStatusWithdrawal::class);


    /** 一般API群 **/

    /**
     * ユーザー
     * Users
     */
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);

});