<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popularity extends Model
{
    protected $table = 't_popularity';
    protected $fillable = [
        'title',
        'clicked',
    ];
}
