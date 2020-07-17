<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Anchu\Ftp\Facades\Ftp;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;


class FtpController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function ftpShow(Request $request,$type,$folder)
    {   
        
        if($type=="Others"){    
                $contents=  get_other_folder_contents($folder);
            }

        if($type=="Games"){    
                $contents=  get_game_folder_contents($folder);
            }    
        
        $data = array();
        $i = 0;
        foreach ($contents as $content) {

            $data[$i]['name'] = $content->name;
            $data[$i]['type'] = $content->type;
            $data[$i]['path'] = $content->path;
            if ($data[$i]['type'] != "folder") {

                $data[$i]['icon'] = get_file_icon($data[$i]['name']);
                $data[$i]['size'] = formatBytes($content->size);


            } else {
                $data[$i]['icon'] = "N/A";
                $data[$i]['size'] = "N/A";
            }
            $i++;
        }

        $rawlist = $data;

        $back_button=get_back_button($folder);

       
        $agent = new Agent();
        
        if($agent->isMobile()){

            
            return view('Mobile.ftp_mobile', compact('rawlist', 'back_button'));

        }else{
            return view('ftp', compact('rawlist','back_button'));
        }

    }

}
