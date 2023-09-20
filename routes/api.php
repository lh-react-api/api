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

    /**
     * 住所
     * Addresses
     */
    Route::get('my/addresses', \App\Http\Controllers\My\Addresses\Index::class);
    Route::get('my/address/default', \App\Http\Controllers\My\Address\_Default::class);
    Route::patch('/my/address/isDefault', \App\Http\Controllers\My\Address\UpdateIsDefault::class);


    /** 一般API群 **/

    /**
     * ユーザー
     * Users
     */
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);


    /**　管理系API群 **/

    /**
     * 自身の管理者情報を取得
     */
    Route::get('my/admin/adminAuthorities', \App\Http\Controllers\My\Admin\AdminAuthorities\Index::class);

    /**
     * 住所
     * Addresses
     */
    Route::get('admin/addresses', \App\Http\Controllers\Admin\Addresses\index::class);
    Route::get('admin/addresses/{address_id}', \App\Http\Controllers\Admin\Addresses\Show::class);
    Route::post('admin/addresses', \App\Http\Controllers\Admin\Addresses\Store::class);
    Route::put('admin/addresses/{address_id}', \App\Http\Controllers\Admin\Addresses\Update::class);
    Route::delete('admin/addresses/{address_id}', \App\Http\Controllers\Admin\Addresses\Delete::class);

    /**
     * メーカー
     * Makers
     */
    Route::get('admin/makers', \App\Http\Controllers\Admin\Makers\index::class);
    Route::get('admin/makers/{maker_id}', \App\Http\Controllers\Admin\Makers\Show::class);
    Route::post('admin/makers', \App\Http\Controllers\Admin\Makers\Store::class);
    Route::put('admin/makers/{maker_id}', \App\Http\Controllers\Admin\Makers\Update::class);
    Route::delete('admin/makers/{maker_id}', \App\Http\Controllers\Admin\Makers\Delete::class);
});