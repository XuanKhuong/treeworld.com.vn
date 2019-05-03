<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Accessory;
class Accessory extends Model
{
    protected $table = 'accessories';
    protected $fillable = ['id','name','thumbnail','description','price','category_id','created_at','updated_at'];
}
