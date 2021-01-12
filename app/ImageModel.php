<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
   protected $table = 'produk_image';
   protected $fillable = [
       'product_id',
       'img1',
       'img2',
       'img3',
       'img4',
       'img5'
    ];
}
