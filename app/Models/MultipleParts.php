<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class MultipleParts extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'muliple_parts';

    protected $primaryKey = 'mul_part_id';

    protected $fillable = [
        'mul_part_id',
        'order_id',
        'parts',
        'quantity',
        'created_at',
        'updated_at',
    ];

}
