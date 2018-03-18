<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageRatings extends Model
{
    protected $table = 'package_ratings';

    protected $fillable = [
        'package_id',
        'user_id',
        'rating',
        'comment'
    ];
}
