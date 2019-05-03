<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductDetail;

class ProductDetail extends Model
{
    protected $table = 'detail_products';
    protected $fillable = ['id','name','quantity','color_id','price','life_expectancy','product_id','status','slug','sale_price','created_at','updated_at'];
}
