<?php

namespace App\Utilities;

use App\Enums\AdminAuthorities\AdminAuthoritiesAction;
use Illuminate\Support\Facades\Route;

class AdminAuthorityUtils
{
    /**
     * 管理者権限チェック
     *
     * @param integer $action
     * @param AdminAuthoritiesAction $authority
     * @return boolean 操作権限有無
     */
    public static function checkAuthority(int $action, AdminAuthoritiesAction $authority)
    {   
        // TODO
        // アクション値関連の扱いが不透明のため一旦ゼロパディングして対象の位置を取り出してる
        $strAction = str_pad(strval($action), 4, "0", STR_PAD_LEFT);
        return substr($strAction, AdminAuthoritiesAction::getCullum($authority), 1) === '1';
    }

    /**
     * アクション名取得
     *
     * @return string アクション名
     */
    public static function getActionName()
    {
        $route = explode('\\', Route::currentRouteAction());
        $lastKey = array_key_last(explode('\\', Route::currentRouteAction()));
        return $route[$lastKey];
    }

    /**
     * コントローラー名取得
     *
     * @return string コントーローラー名
     */
    public static function getContorolerName()
    {
        $route = explode('\\', Route::currentRouteAction());
        $lastKey = array_key_last(explode('\\', Route::currentRouteAction()));
        return $route[$lastKey - 1];
    }
}
