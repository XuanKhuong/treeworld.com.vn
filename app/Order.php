<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id','name_customer','address_customer','mobile_customer','customer_id','status','employee_id','total','created_at','updated_at'];
}
