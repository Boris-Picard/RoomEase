<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_HOST = 'ROLE_HOST';
    case ROLE_GUEST = 'ROLE_GUEST';
}
