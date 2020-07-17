<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class SamFacebookController extends Controller
{

    public function index(){

    }
    public function check(){

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if (!Auth::check()) {
          return redirect('login/facebook');
            //return redirect($_SESSION['from_url']);
        }
        else
            //return redirect($_SESSION['from_url']);
            return redirect( Session::get('from_url'));

    }
    public function register(){

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $facebook_id  =   $_SESSION['facebook_id'];
        $name =        $_SESSION['name'];
        $email =    $_SESSION['email'];
        $avatar = $_SESSION['avatar'];
        $isp_username = $_POST['isp_username'];
        $isp_name = $_POST['isp_name'];
        $address = $_POST['address'];

        if ($authUser = User::where('email', $email)->first()) {
           $authUser->update([
                'facebook_id'        => $facebook_id,
                'name'  => $name,
                'email'  => $email,
                'avatar'  => $avatar,
                'isp_name' => $isp_name,
                'isp_username' => $isp_username,
                'address' => $address
            ]);
        }
        else{
            $authUser = User::create([
                'facebook_id'        => $facebook_id,
                'name'  => $name,
                'email'  => $email,
                'avatar'  => $avatar,
                'isp_name' => $isp_name,
                'isp_username' => $isp_username,
                'address' => $address
            ]);

        }
        Auth::login($authUser, true);
        return redirect( Session::get('from_url'));

    }
}
