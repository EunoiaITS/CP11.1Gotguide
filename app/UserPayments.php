<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayments extends Model
{
    protected $table = 'user_payments';
    protected $fillable = [
        'user_id',
        'offer_id',
        'payment_id',
        'amount',
        'payment_type',
        'payment_time',
        'payment_status',
        'payment_expiry'
    ];
}
