<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'admin';
    case PEMILIKUSAHA = 'pemilikUsaha';
    case PELANGGAN = 'pelanggan';
}
