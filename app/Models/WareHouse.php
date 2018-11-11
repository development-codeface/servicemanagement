<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class WareHouse extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'asp_list';

    protected $primaryKey = 'warehouse_id';

    protected $fillable = [
        'warehouse_id',
        'warehouse',
        'name',
        'code',
        'address',
        'tel_number1',
        'tel_number2',
    ];

}
