<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => [
//TODO: 認証設定したら入れる、今回はSanctum使いたい
//     'auth:api',
    'transaction',
    'formatRequestParam'
]], function () {
    Route::get('users', \App\Http\Controllers\Users\Index::class);
    Route::get('users/{user_id}', \App\Http\Controllers\Users\Show::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);

});