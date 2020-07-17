<?php

namespace App\Http\Controllers\dashboard;
use Hash;
use DB;
use Redirect;
use Session;
use Illuminate\Http\Request;
////////////////////////////////////////
use App\Http\Controllers\Controller;
///////////////////////////////////////
class PasswordController extends Controller
{	

	private $master_password;	

	public function __construct()
	{
		$this->master_password = '123456';

	}

	public function reset_password(Request $request)
    {  	
		if($request->{'master_password'}!=$this->master_password)
		{
		return redirect()->to('/dashboard_reset_password')->with('alert', 'Wrong Master Password, Access Denied !');
		}
		else{
			$password = Hash::make($request->{'confirm_new_password'});
			\DB::table('admin_table')->where('id',1)->update(
			[
			'password' => $password
			]);			
			Session::put(['password'=>'']);
			return redirect('login')->with('alert', 'New password created!');
		}
    }	
}
