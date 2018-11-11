<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Mileage extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'data_mileage';

    protected $primaryKey = 'mil_id';

    protected $fillable = [
        'mil_id',
        'min_mil',
        'max_mil',
        'mil_amount',
    
        'created_at',
        'updated_at',
    ];

}
