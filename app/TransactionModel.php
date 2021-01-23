<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = "transaction";
    protected $fillable = [
       'visitor_id',
       'store_id',
       'store_name',
       'product_name',
       'product_price',
       'product_key',
       'product_img1',
       'address_seller',
       'status'
    ];
}
