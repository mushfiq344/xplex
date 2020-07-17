<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function forum()
    {

        return "hello!";

    }

    public function forum2()
    {
        if(session_status() == PHP_SESSION_NONE){

            session_start();
        }

        if (!Auth::check()) {
            $_SESSION['from_url'] = '/forum2';
            return redirect('login/facebook');
        } else {
            $result = DB::table('file_request')->orderByDesc('created_at')->get();

            $userid = Auth::user()->id;

            $request = DB::table('single_user_request_list')->where('userid', $userid)->get();
            return view('forum2', compact('result', 'request'));
        }

    }


    public function request(Request $request)
    {
        $username = Auth::user()->name;

/*        if($request->ajax()){
            $filename = $request->filename;
            $type = $request->type;
            $link = $request->link;
            $result = DB::table('file_request')->where('file_name', $filename)->first();
            if ($result) {
                $warning = 1;
                echo json_encode(array($warning, $result));       //if the requested file is already in database,show that data with warning
            } else {
                $warning = 0;
                DB::insert('insert into file_request (file_name,type,download_from,username,status,total_follow,download_link) values(?,?,?,?,?,?,?)',
                    [$filename, $type, $link, $username, 0, 1, 'N/A']);
                $result = DB::table('file_request')->orderByDesc('created_at')->first();
                echo json_encode(array($warning, $result));
            }

            $warning = 1;
            $result = $username;
            echo json_encode(array($warning,$result));
        }*/

        if($request->ajax()) {
            $filename = $request->filename;
            $type = $request->type;
            $link = $request->link;

            $result = DB::table('file_request')->where('file_name', $filename)->first();

            if ($result) {
                $warning = 1;
                echo json_encode(array($warning, $result));       //if the requested file is already in database,show that data with warning
            }
            else {
                $warning = 0;
                DB::insert('insert into file_request (file_name,type,download_from,username,status,total_follow,download_link) values(?,?,?,?,?,?,?)',
                    [$filename, $type, $link, $username, 0, 1, 'N/A']);
                $result = DB::table('file_request')->orderByDesc('created_at')->first();
                echo json_encode(array($warning, $result));

            }
        }
    }

    public function follow(Request $request, $id, $following)
    {
        $userid = Auth::user()->id;
        if ($following == "1") {
            DB::insert('insert into single_user_request_list (post_id,userid) values(?,?)',
                [$id, $userid]);
            DB::table('file_request')->where('id', $id)->increment('total_follow');
            $flag = 0;
        } else {
            DB::table('single_user_request_list')->where('post_id', $id)->where('userid', $userid)->delete();
            DB::table('file_request')->where('id', $id)->decrement('total_follow');
            $flag = 1;
        }

        return response()->json($flag);

    }


}
