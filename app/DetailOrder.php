<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = 'detail_orders';
    protected $fillable = ['id','name','product_id','detail_product_id','quantity','price','sale_price','unit','total','created_at','updated_at'];
}
