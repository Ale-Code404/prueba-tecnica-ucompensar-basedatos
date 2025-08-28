<?php

namespace App\Users;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
}
