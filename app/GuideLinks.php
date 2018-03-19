<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideLinks extends Model
{
    protected $table = 'guide_links';

    protected $fillable = [
        'user_id',
        'category',
        'link'
    ];
}
