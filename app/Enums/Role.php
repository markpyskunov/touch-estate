<?php

namespace App\Enums;

enum Role: string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case REALTOR = 'realtor';

    /**
     * @return Role[]
     */
    public static function all(): array
    {
        return [
            self::SUPERADMIN,
            self::ADMIN,
            self::MANAGER,
            self::REALTOR,
        ];
    }
}
