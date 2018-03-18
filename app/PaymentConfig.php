<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentConfig extends Model
{
    protected $table = 'payment_config';

    protected $fillable = [
        'payment_type',
        'amount',
        'currency',
        'is_promotional',
        'details',
        'promotional_amount',
        'duration'
    ];
}
