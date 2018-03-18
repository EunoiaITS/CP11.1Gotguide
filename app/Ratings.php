<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{

    protected $table = 'agent_ratings';

    protected $fillable = [
        'agent_id',
        'user_id',
        'rating',
        'comment'
    ];
}
