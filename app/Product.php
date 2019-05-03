<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','name','description','thumbnail','category_id','slug','user_id','view_count','created_at','updated_at'];
}
