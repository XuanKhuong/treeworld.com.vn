<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['id','name','thumbnail','address','email','phone','user_id','level_user','created_at','updated_at'];
}
