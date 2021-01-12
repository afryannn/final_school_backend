<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreModel extends Model
{
    protected $table = 'store';
    protected $fillable = [
        'img_profil',
        'img_banner',
        'name',
        'user_id',
        'description',
        'address',
    ];
}
