<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class packages extends Model
{

    protected $fillable = [
        'agent_id',
        'package_name',
        'package_price',
        'package_details',
        'available_date'
    ];
}
