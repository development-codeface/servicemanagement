<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class PartsOrder extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'parts_order';

    protected $primaryKey = 'part_order_id';

    protected $fillable = [
        'part_id',
        'order_date',
        'parts_item',
        'parts_qty',
        'delivery_date',
        'remark',
        'isapprove',
        'creator',
        'approver',
        'location',
        'type',
    
    ];

}
