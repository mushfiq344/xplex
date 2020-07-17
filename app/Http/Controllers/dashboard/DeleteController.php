<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\Models\Admins;
class DeleteController extends Controller
{


    public function delete_content(Request $request)
 	{
 		if($request->ajax()){

 			$movies=DB::table($request->table)->where('id',$request->id)->get();

 			// return Response($this->default_poster);

 			DB::table($request->table)->where('id', $request->id)->delete();




 			if($movies[0]->poster_url_value!=default_poster){
 				
 				File::delete(ltrim($movies[0]->poster_url_value,"/"));					
			
			}

			if($movies[0]->cover_url_value!=default_cover){
 				
 				File::delete(ltrim($movies[0]->cover_url_value,"/"));					
			
			}

			return Response('done');
			
		}
	}
    public function delete_tv_show(Request $request)
 	{
 		if($request->ajax()){
 			$tv_shows=DB::table('tv_show')->where('id',$request->search)->get();

 			

 			DB::table('tv_show')->where('id', $request->search)->delete();

 			if($tv_shows[0]->poster_url_value!=default_poster){
 				
 				File::delete(ltrim($tv_shows[0]->poster_url_value,"/"));					
			
			}if($tv_shows[0]->cover_url_value!=default_cover){
 				
 				File::delete(ltrim($tv_shows[0]->cover_url_value,"/"));					
			
			}
			
			
		}
	}
    public function delete_pc_games(Request $request)
    {
 		if($request->ajax()){

 			$pc_games=DB::table('pc_games')->where('id',$request->search)->get();

 			DB::table('pc_games')->where('id', $request->search)->delete();

 			if($pc_games[0]->poster_url_value!=default_poster){
 				
 				File::delete(ltrim($pc_games[0]->poster_url_value,"/"));					
			
			}

			if($pc_games[0]->cover_url_value!=default_cover){
 				
 				File::delete(ltrim($pc_games[0]->cover_url_value,"/"));					
			
			}


 			
 		}
	}


		        public function delete_ad(Request $request)
 	{
	 		if($request->ajax()){
	 		$ads=DB::table('tv_ads_list')->where('id',$request->search)->get();
	      		File::delete(ltrim($ads[0]->name,"/"));	
			DB::table('tv_ads_list')->where('id', $request->search)->delete();
		}

	}

    public function delete_admin(Request $request)
    {
        if($request->ajax()){

            Admins::where('user_name',$request->username)->delete();
            return Response('done');

        }
    }

}
