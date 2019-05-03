<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Address;
class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['id','address','created_at','updated_at'];
}
