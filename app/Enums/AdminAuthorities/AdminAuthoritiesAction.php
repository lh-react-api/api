<?php

namespace App\Enums\AdminAuthorities;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum AdminAuthoritiesAction: string implements EnumInterface
{
    use EnumTrait;
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::CREATE => '作成',
            self::READ => '読取',
            self::UPDATE => '更新',
            self::DELETE => '削除',
        };
    }

    /**
     * 引数に応じて権限チェックのカラム位置を返す
     *
     * @param AdminAuthoritiesAction $authority
     * @return int
     */
    public static function getCullum($authority) {
        switch ($authority) {
            case AdminAuthoritiesAction::CREATE:
                return 0;
            case AdminAuthoritiesAction::READ:
                return 1;
            case AdminAuthoritiesAction::UPDATE:
                return 2;
            default :
                return 3;
        }
    }

    /**
     * 引数に応じて権限チェックのカラム位置を返す
     *
     * @param int $cullum
     * @return int
     */
    public static function getAcrion(int $cullum) {
        switch ($cullum) {
            case 0:
                return AdminAuthoritiesAction::CREATE->value;
            case 1:
                return AdminAuthoritiesAction::READ->value;
            case 2:
                return AdminAuthoritiesAction::UPDATE->value;
            default :
                return AdminAuthoritiesAction::DELETE->value;
        }
    }
}