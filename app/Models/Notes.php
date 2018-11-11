<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Notes extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'part_order_notes';

    protected $primaryKey = 'note_id';

    protected $fillable = [
        'note_id',
        'part_order',
        'note_date',
        'isapprove',
        'creater',
        'note',
        'created_at',
        'updated_at',
    ];

}
