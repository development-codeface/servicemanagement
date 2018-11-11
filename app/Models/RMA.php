<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class RMA extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'gma';

    protected $primaryKey = 'gma_id';

    protected $fillable = [
        'grn_id',
        'order_id',
        'panel_serial_no',
        'delear_Account_numner',
        'dealer_nam',
        'dealer_addr',
        'symptom',
        'reason_for_return',
        'issue_image',
        'ex_number',
        'model',
        'amount',
        'panel_model',
        'seriel_no',
        'warranty_card',
        'vertical_line',
        'vertical_block',
        'hori_line',
        'horil_block',
        'no_display',
        'abnormal_color',
        'uniformity_defect',
        'dot_screen',
        'white_screen',
        'flicker',
        'back_light',
        'abnormal_pic',
        'purchase_date',
        'complaints',
        'credit_note',
        'application_date',
        'date_received',
		'is_cn_ex'
    ];

}
