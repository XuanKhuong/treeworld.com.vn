<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Color;
class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['id','code_color','name','created_at','updated_at'];
}
