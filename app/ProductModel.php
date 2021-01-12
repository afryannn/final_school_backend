<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
  protected $table = 'produk';
  protected $fillable = [
    'store_id',
    'product_name',
    'product_price',
    'category',
    'description',
    'stock',
  ];
}
