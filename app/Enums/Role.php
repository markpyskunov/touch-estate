<?php

namespace App\Enums;

enum Role: string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case AGENT = 'agent';

    /**
     * @return Role[]
     */
    public static function all(): array
    {
        return [
            self::SUPERADMIN,
            self::ADMIN,
            self::AGENT,
        ];
    }
}
