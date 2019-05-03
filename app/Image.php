<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['id','thumbnail','product_id','slug','created_at','updated_at'];
}
