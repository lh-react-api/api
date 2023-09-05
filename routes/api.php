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

    /**
     * 注文情報
     * orders
     */
    Route::get('my/orders', \App\Http\Controllers\My\orders\Index::class);

    /**
     * クレジットカード
     * Credits
     */
    Route::get('my/credits', \App\Http\Controllers\My\Credits\Index::class);
    Route::delete('my/credits/{credit_id}', \App\Http\Controllers\My\Credits\Delete::class);

    /**
     * stripe
     */
    Route::get('my/stripe/clientSecret', \App\Http\Controllers\My\Stripe\GeneratClientSecret::class);

    /** 一般API群 **/

    /**
     * ユーザー
     * Users
     */
    Route::get('users/authed', \App\Http\Controllers\Users\Authed::class);
    Route::post('users', \App\Http\Controllers\Users\Store::class);
    Route::put('users/{user_id}', \App\Http\Controllers\Users\Update::class);
    Route::delete('users/{user_id}', \App\Http\Controllers\Users\Delete::class);

    /**
     * 住所
     * Addresses
     */
    Route::post('addresses', \App\Http\Controllers\Addresses\Store::class);
    Route::put('addresses/{address_id}', \App\Http\Controllers\Addresses\Update::class);
    Route::delete('addresses/{address_id}', \App\Http\Controllers\Addresses\Delete::class);


    /**
     * ジャンル
     * genres
     */
    Route::get('genres', \App\Http\Controllers\Genres\index::class);

    /**
     * 配達時間マスタ
     * deliverTimes
     */
    Route::get('deliverTimes', \App\Http\Controllers\DeliverTimes\index::class);

    /**
     * 商品原本
     * ProductOrigin
     */
    Route::get('productOrigins', \App\Http\Controllers\ProductOrigins\index::class);
    Route::get('productOrigins/{product_origin_id}', \App\Http\Controllers\ProductOrigins\Show::class);

    /**
     * 商品レビュー
     * ProductReviews
     */
    Route::post('productReviews', \App\Http\Controllers\ProductReviews\Store::class);

    /**
     * おすすめ商品
     * recommendProducts
     */
    Route::get('recommendProducts', \App\Http\Controllers\RecommendProducts\Index::class);

    /**
     * お問い合わせ
     * Inquiries
     */
    Route::post('inquiries', \App\Http\Controllers\Inquiries\Store::class);

    /**
     * お知らせ
     * Notices
     */
    Route::get('notices', \App\Http\Controllers\Notices\Index::class);
    Route::get('notices/{notice_id}', \App\Http\Controllers\Notices\Show::class);

    /**
     * 注文情報
     * orders
     */
    Route::get('orders/{order_id}', \App\Http\Controllers\Orders\Show::class);
    Route::post('orders', \App\Http\Controllers\Orders\Store::class);
    Route::patch('orders/{order_id}/credit', \App\Http\Controllers\Orders\UpdateCredit::class);
    Route::delete('orders/{order_id}', \App\Http\Controllers\Orders\DELETE::class);


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

    /**
     * お知らせ
     * Notices
     */
    Route::get('admin/notices', \App\Http\Controllers\Admin\Notices\index::class);
    Route::get('admin/notices/{notice_id}', \App\Http\Controllers\Admin\Notices\Show::class);
    Route::post('admin/notices', \App\Http\Controllers\Admin\Notices\Store::class);
    Route::put('admin/notices/{notice_id}', \App\Http\Controllers\Admin\Notices\Update::class);
    Route::delete('admin/notices/{notice_id}', \App\Http\Controllers\Admin\Notices\Delete::class);

    /**
     * 商品ランク
     * productRanks
     */
    Route::get('admin/productRanks', \App\Http\Controllers\Admin\ProductRanks\index::class);
    Route::get('admin/productRanks/{product_rank_id}', \App\Http\Controllers\Admin\ProductRanks\Show::class);
    Route::post('admin/productRanks', \App\Http\Controllers\Admin\ProductRanks\Store::class);
    Route::put('admin/productRanks/{product_rank_id}', \App\Http\Controllers\Admin\ProductRanks\Update::class);
    Route::delete('admin/productRanks/{product_rank_id}', \App\Http\Controllers\Admin\ProductRanks\Delete::class);

    /**
     * 商品レビュー
     * ProductReviews
     */
    Route::get('admin/productReviews', \App\Http\Controllers\Admin\ProductReviews\index::class);
    Route::get('admin/productReviews/{product_review_id}', \App\Http\Controllers\Admin\ProductReviews\Show::class);
    Route::post('admin/productReviews', \App\Http\Controllers\Admin\ProductReviews\Store::class);
    Route::put('admin/productReviews/{product_review_id}', \App\Http\Controllers\Admin\ProductReviews\Update::class);
    Route::delete('admin/productReviews/{product_review_id}', \App\Http\Controllers\Admin\ProductReviews\Delete::class);

    /**
     * おすすめ商品
     * RecommendProducts
     */
    Route::get('admin/recommendProducts', \App\Http\Controllers\Admin\RecommendProducts\index::class);
    Route::get('admin/recommendProducts/{recommend_product_id}', \App\Http\Controllers\Admin\RecommendProducts\Show::class);
    Route::post('admin/recommendProducts', \App\Http\Controllers\Admin\RecommendProducts\Store::class);
    Route::put('admin/recommendProducts/{recommend_product_id}', \App\Http\Controllers\Admin\RecommendProducts\Update::class);
    Route::delete('admin/recommendProducts/{recommend_product_id}', \App\Http\Controllers\Admin\RecommendProducts\Delete::class);

    /**
     * 配達情報
     * delivers
     */
    Route::get('admin/delivers', \App\Http\Controllers\Admin\Delivers\index::class);
    Route::get('admin/delivers/{deliver_id}', \App\Http\Controllers\Admin\Delivers\Show::class);
    Route::post('admin/delivers', \App\Http\Controllers\Admin\Delivers\Store::class);
    Route::put('admin/delivers/{deliver_id}', \App\Http\Controllers\Admin\Delivers\Update::class);
    Route::delete('admin/delivers/{deliver_id}', \App\Http\Controllers\Admin\Delivers\Delete::class);
    /**
     * 配達情報マスタ
     * DeliverTimes
     */
    Route::get('admin/deliverTimes', \App\Http\Controllers\Admin\DeliverTimes\index::class);
    Route::get('admin/deliverTimes/{deliver_time_id}', \App\Http\Controllers\Admin\DeliverTimes\Show::class);
    Route::post('admin/deliverTimes', \App\Http\Controllers\Admin\DeliverTimes\Store::class);
    Route::put('admin/deliverTimes/{deliver_time_id}', \App\Http\Controllers\Admin\DeliverTimes\Update::class);
    Route::delete('admin/deliverTimes/{deliver_time_id}', \App\Http\Controllers\Admin\DeliverTimes\Delete::class);

    /**
     * お問い合わせ
     * Inqueries
     */
    Route::get('admin/inquiries', \App\Http\Controllers\Admin\Inquiries\index::class);
    Route::get('admin/inquiries/{inquiry_id}', \App\Http\Controllers\Admin\Inquiries\Show::class);
    Route::post('admin/inquiries', \App\Http\Controllers\Admin\Inquiries\Store::class);
    Route::put('admin/inquiries/{inquiry_id}', \App\Http\Controllers\Admin\Inquiries\Update::class);
    Route::delete('admin/inquiries/{inquiry_id}', \App\Http\Controllers\Admin\Inquiries\Delete::class);
    /**
     * お問い合わせ種別
     * InquiryTypes
     */
    Route::get('admin/inquiryTypes', \App\Http\Controllers\Admin\InquiryTypes\index::class);
    Route::get('admin/inquiryTypes/{inquiry_type_id}', \App\Http\Controllers\Admin\InquiryTypes\Show::class);
    Route::post('admin/inquiryTypes', \App\Http\Controllers\Admin\InquiryTypes\Store::class);
    Route::put('admin/inquiryTypes/{inquiry_type_id}', \App\Http\Controllers\Admin\InquiryTypes\Update::class);
    Route::delete('admin/inquiryTypes/{inquiry_type_id}', \App\Http\Controllers\Admin\InquiryTypes\Delete::class);

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