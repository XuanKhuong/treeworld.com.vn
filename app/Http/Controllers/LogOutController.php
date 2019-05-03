<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
class LogOutController extends Controller
{
    public function logout () {
	    //logout user
	    auth()->logout();
	    // redirect to homepage
	    return view('auth.login');
	}
}
