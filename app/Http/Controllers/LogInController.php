<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth; //use thư viện auth
class LogInController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');//return ra trang login để đăng nhập
    }

    public function postLogin(Request $request)
    {
        $rules = [
        	'email' => 'required|email',
        	'password' => 'required|min:4'
        ];

        $messages = [
        	'email.required' => 'Email la bat buoc',
        	'email.email' => 'Email khong dung dinh dang',
        	'password.required' => 'Mat khau la bat buoc',
        	'email.min' => 'Mat khau phai it nhat 4 ky tu',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
        	return redirect()->back()->withErrors($validator);
        }

        else{
        	
        }
    }

    
}
