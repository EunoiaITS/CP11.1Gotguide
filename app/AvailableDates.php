<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableDates extends Model
{
    protected $table = 'available_dates';

    protected $fillable = [
        'user_id',
        'available_dates',
        'available_time'
    ];
}
