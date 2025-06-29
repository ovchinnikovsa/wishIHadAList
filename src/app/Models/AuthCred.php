<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthCred extends Model
{
    protected $table = 'auth_creds';

    protected $fillable = [
        'name',
        'email',
        'foreign_id',
        'token',
        'refresh_token',
        'type_id',
        'expires_in',
    ];
}
