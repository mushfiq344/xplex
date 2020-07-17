<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use Session;
use Hash;
use DB;
use \Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// include composer autoload

// import the Intervention Image Manager Class
use Image;

class PagesController extends Controller
{

    public function __construct()
    {
    }

    public function authenticate()
    {
        return redirect('login');
    }

    public function logout()
    {
        Session::put(['password' => ""]);
        Session::put(['username' => ""]);
        Session::put(['admin_type' => ""]);
        return redirect('login')->with('alert', 'Session Expired!');
    }

    public function signout()
    {
        return redirect('/login');
    }

    public function login()
    {
        Session::put(['password' => ""]);
        Session::put(['username' => ""]);
        Session::put(['admin_type' => ""]);
        return view('dashboard.authenticate');
    }


    public function set_session(Request $request)
    {
        $password = $request->{'password'};
        $username = $request->{'username'};

        $admin = DB::table('admin_table')->where('user_name', $username)->first();

        //          return var_dump($admin);
        if ($admin != "" && Hash::check($password, $admin->{'password'})) {
            Session::put(['password' => $password]);
            Session::put(['username' => $username]);
            Session::put(['admin_type' => $admin->{'admin_type'}]);

            return redirect('dashboard_movie');
        } else {
            Session::put(['password' => '']);
            Session::put(['username' => '']);
            Session::put(['admin_type' => ""]);
            //return redirect('authenticate');
            return redirect('login')->with('alert', 'Wrong Password or Username!');
        }
    }


    /////////////////////////// Get to the insert page ///////////////////////////////////////////

    public function dashboard_game()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_game');
    }


    public function dashboard_tv_show()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_tv_show');
    }

    public function dashboard_movie()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_movie');
    }


    public function dashboard_explore()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_explore');
    }


    public function dashboard_reset_password()
    {

        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_reset_password');
    }

    public function dashboard_backup()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        return view('dashboard.dashboard_backup');
    }


    public function dashboard_users()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();
        $admins = DB::table('admin_table')->orderBy('updated_at', 'desc')->get();
        //         return $admins;
        foreach ($admins as $admin) {
            $admin->uploaded = DB::table('movie_approval')->where('user_name', $admin->user_name)->count();
            $admin->approved = DB::table('movie_approval')->where('user_name', $admin->user_name)->where('status', 1)->count();
        }

        return view('dashboard.dashboard_users', compact('admins'));
    }


    public function dashboard_ads()
    {
        $current_time = Carbon::now()->subDays(3)->toDateTimeString();
        DB::table('file_request')->where('created_at', '<', $current_time)->delete();

        return view('dashboard.dashboard_ads');
    }



    // Edit Movies
    public function edit_movie($table, $id)
    {
        if (Session::get('admin_type') == 'uploader') {
            if ($table == "movie_approval") {
                $table_row = DB::table($table)->where('id', $id)->first();
                if ($table_row == NULL) {
                    return redirect()->to('/dashboard_explore')->with('alert', 'No such Movie Id exists !');
                } else {
                    if ($table_row->user_name == Session::get('username')) {
                        if ($table_row->status == 1) {
                            return redirect()->to('/dashboard_explore')->with('alert', 'You Do Not Have Permission');
                        }
                        return view('editing_dashboard.edit_movie', compact('table_row', 'table'));
                    } else {
                        return redirect()->to('/dashboard_explore')->with('alert', 'You Do Not Have Permission');
                    }
                }
            } else {
                return redirect()->to('/dashboard_explore')->with('alert', 'You Do Not Have Permission');
            }
        } else {
            $table_row = DB::table($table)->where('id', $id)->first();
            if ($table_row == NULL) {
                return redirect()->to('/dashboard_explore')->with('alert', 'No such Movie Id exists !');
            }
            return view('editing_dashboard.edit_movie', compact('table_row', 'table'));
        }
    }

    // Edit Tv Shows
    public function edit_tv_show($id)
    {
        if (empty(Session::get('password'))) {
            return redirect('login')->with('alert', 'Session Expired!');
        }


        $table_row = DB::table('tv_show')->where('id', $id)->get();
        if (count($table_row) == 0) {
            return redirect()->to('/dashboard_explore')->with(
                'alert',
                'No such Tv Show Id exists !'
            );
        }
        Session::put('tv_show_id', $id);
        return view('editing_dashboard.edit_tv_show', compact('table_row'));
    }

    // edit pc games
    public function edit_pc_games($id)
    {

        if (empty(Session::get('password'))) {
            return redirect('login')->with('alert', 'Session Expired!');
        }
        $table_row = DB::table('pc_games')->where('id', $id)->get();
        if (count($table_row) == 0) {
            return redirect()->to('/dashboard_explore')->with(
                'alert',
                'No such PC Game Id exists !'
            );
        }
        Session::put('pc_game_id', $id);
        return view('editing_dashboard.edit_pc_games', compact('table_row'));
    }
}
