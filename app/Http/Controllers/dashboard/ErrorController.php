<?php

namespace App\Http\Controllers\dashboard;
use Session;
use Illuminate\Http\Request;
////////////////////////////////////////
use App\Http\Controllers\Controller;
///////////////////////////////////////
class ErrorController extends Controller
{
    public function __construct()
    {}

    public function handle_error()
    {
		if(empty(Session::get('password')))
		{
		 	return redirect('login');
		}
		else {
			return redirect('dashboard_movie');
		}
	}

}