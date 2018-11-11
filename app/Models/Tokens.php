<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Tokens extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'tokens';

    protected $primaryKey = 'token_id';

    protected $fillable = [
        'token_code',
        'token_type',
        'token_status',
        'user_id',
        'expired_at',
        'created_at',
        'updated_at',
    ];

}
