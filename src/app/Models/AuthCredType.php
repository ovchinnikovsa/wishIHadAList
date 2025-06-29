<?php

namespace App\Models;

use App\Models\Enums\AuthCredTypeEnum;
use Illuminate\Database\Eloquent\Model;

class AuthCredType extends Model
{
    protected $table = 'auth_cred_types';

    protected $casts = [
        'type' => AuthCredTypeEnum::class,
    ];
}
