<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class GRN extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'grn';

    protected $primaryKey = 'grn_id';

    protected $fillable = [
        'grn_id',
        'credit_note',
        'order_id',
        'reason_for_retrun',
        'purchase_date',
        'tech_prob',
        'dented',
        'photogr',
        'return_acc',
        'issue_image',
        'amount',
        'ex_number',
        'goods_date',
        'seriel_no',
        'spare_part_no',
        'application_date',
        'complaint_date',
		'is_ex_cn',
		'place_order',
		'pending_part',
		'dealer_name',
		'dealer_acc',
		'dealer_address',
		'sell_price',
        'attach_proof',
        'grn_remarks',
    ];

}
