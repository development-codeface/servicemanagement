<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Parts extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'parts_list';

    protected $primaryKey = 'part_id';

    protected $fillable = [
        'part_id',
        'part_no',
        'parts_description',
        'last_kit_bom_used',
        'dealer_price',
        'customer_price',
        'TASS_price',
        'avl_qty',
        'created_at',
        'updated_at',
    ];

}
