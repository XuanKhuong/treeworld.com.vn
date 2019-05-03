<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['id','name','thumbnail','address','email','phone','user_id','level_user'];
}
