<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Claim extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'claim';

    protected $primaryKey = 'claim_id';

    protected $fillable = [
        'claim_id',
        'claim_amount',
        'mileage',
        'job_id',
        'labour',
        'isapprove',
        'remarks'
    ];

}
