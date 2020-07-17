<?php

namespace App\Http\Controllers\dashboard;
use Session;
use Illuminate\Http\Request;
use App\Classes\PricesClass;
use App\companies;
use DB;
use Image;
////////////////////////////////////////
use App\Http\Controllers\Controller;
///////////////////////////////////////

class AdsController extends Controller
{
          public function upload_channel_ads(Request $request)
   {
   		// return $request;
        $tv_ads = DB::table('tv_ads_list')->get();        
        if(count($tv_ads)==8){
            return redirect()->back()->with('alert','You already have 8 Advertisement!.Can not add more.'); 
        }
        else {



      // return $request;
        $channel_logos=array();
        $i=0;
        if(count($request->file('channel_logos'))!=0){
          $this->validate($request, [
            'channel_logos' => 'required',
            'channel_logos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048'
          ]);
          if($request->hasfile('channel_logos'))
          {   
              foreach ($request->file('channel_logos') as $image) {
                $timestamp = now()->timestamp;
                $name=$timestamp.'_'.$image->getClientOriginalName();
                $image->move('images/channel_ads_logos', $name);
                $channel_logos[$i] = $name;
                $i++;
                 $img = Image::make('images/channel_ads_logos/'.$name);
                 $img->resize(500,750);
                 $img->save();

              }
          }
        }

        $link=$request->input('link');
    	DB::insert('insert into tv_ads_list(name,link) values(?,?)',['/images/channel_ads_logos/'.$channel_logos[0],$link]);
      	return redirect()->back()->with('alert','Uploaded Advertisement!'); 
   
        }
 	}
}
