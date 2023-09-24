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

    /**
     * ユーザー
     * Users
     */
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);

    /**
     * 商品
     * Item
     */
    Route::get('items', \App\Http\Controllers\Items\Index::class);
    Route::get('items/{id}', \App\Http\Controllers\Items\Show::class);
    Route::post('items', \App\Http\Controllers\Items\Store::class);
    Route::put('items/{id}', \App\Http\Controllers\Items\Update::class);
    Route::delete('items/{id}', \App\Http\Controllers\Items\Delete::class);

});