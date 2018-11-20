<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Job extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'jobs';

    protected $primaryKey = 'job_id';

    protected $fillable = [
        'job_location',
        'repaire_order_no',
        'customer_id',
        'faulty_code',
        'symptom',
        'resolution',
        'servicetype',
        'technician',
        'status',
        'parts_order',
        'change_code',
        'seriel_number',
        'item',
        'item_purchase_date',
        'item_serial_number',
        'job_date',
        'creater',
        'product_replacement',
        'asp_location',
        'remark',
        'turn_fround_time',
        'description',
        'product',
        'job_type',
        'is_del_parts',
        'is_del_prod',
		'is_claim_appr',

    ];

}
