<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id','name','parent_id','thumbnail','slug','description','created_at','updated_at'];
}
