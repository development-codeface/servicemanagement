<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ProductReplacement extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'product_repalcement_order';

    protected $primaryKey = 'product_replacement_id';

    protected $fillable = [
        'product_replacement_id',
        'order_date',
        'product_id',
        'creator',
        'approver',
        'delivery_date',
        'qty',
        'product_replacement_type',
        'location',
        'rejected_remark',

    ];

}
