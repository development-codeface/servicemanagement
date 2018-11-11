<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'customers';

    protected $primaryKey = 'cu_id';

    protected $fillable = [
        'customer_id',
        'firstname',
        'lastname',
        'cu_address',
        'pincode',
        'phone_no',
        'bussiness_number',
    ];

}
