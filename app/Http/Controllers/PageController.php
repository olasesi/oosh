<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Event;
use App\Models\PagePost;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PageGeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

    public function pageCategoryType(){
        
     $users = DB::table('page_category_types')->get();
 
         return response()->json(['status' => 200,
         'users'=> $users,
        'message'=>'successful']);
     
    }
 

    public function createPage(Request $request){
        $validator = Validator::make($request->all(), [
            'page_name'=>'nullable',
            'page_category'=>'nullable',
            'page_description'=>'nullable',

            ]);
    
            if($validator->fails()){
                return response()->json([
            'validator_errors'=> $validator->messages()
                ]);
            }else{
                $page = Page::create([
                    'user_id' => Auth::user()->id,
                    'page_name' => $request->input('page_name'),
                    'page_category' => $request->input('page_category'),
                    'page_description' => $request->input('page_description'),

                ]);

                DB::table('page_members')->insert(
                    ['page_id' => $page->id, 'user_id' => Auth::user()->id, 'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]
                );

                return response()->json(['status' => 200,
                'message'=>'Successful']);

                 
            }    
    }



    public function showPageList(){
        $pages = DB::table('page_members')->leftJoin('pages', 'pages.id', '=', 'page_members.page_id')->leftJoin('page_category_types', 'page_category_types.id', '=', 'pages.page_category')->select('page_members.id', 'pages.page_name', 'page_category_types.page_category', 'pages.page_description', 'pages.cover_picture', 'pages.created_at')->where('page_members.user_id', Auth::user()->id)->orderByDesc('page_members.created_at')->paginate(12);
        
    return response()->json([
            'status' => 200,
            'pages'=> $pages,
           'message' => 'successful',
           
        ]);
       }


    // public function showAboutPageTab(){

    // }


   public function showAboutPageTab($id){
       //This is to pull out a single page
    $users = Page::where('id', $id)->get();

        return response()->json(['status' => 200,
        'users'=> $users,
       'message'=>'Page successfully loaded']);
    
   }


   public function showEventList(){
       //This will pull out a list of events
    $events = Event::orderBy('created_at', 'desc')->take(7)->get();
        if($users->count() == 0){
            return response()->json(['status' => 200,
           
           'message'=>'No events yet']);
        }else{
            return response()->json(['status' => 200,
            'events'=> $events,
           'message'=>'Events successfully loaded']);
        }
        
    
   }

   public function showRelatedPageList(){
    //This will pull out a list of related groups
 $groups = Page::orderBy('created_at', 'desc')->take(7)->get();
     if($users->count() == 0){
         return response()->json(['status' => 200,
        
        'message'=>'No groups yet']);
     }else{
         return response()->json(['status' => 200,
         'groups'=> $groups,
        'message'=>'Groups successfully loaded']);
     }
     
 
}

public function showPagePost(){
    //This will pull out a list of page post
 $page_post = PagePost::orderBy('created_at', 'desc')->take(10)->get();
     if($users->count() == 0){
         return response()->json(['status' => 200,
        
        'message'=>'No Post']);
     }else{
         return response()->json(['status' => 200,
         'page_post'=> $page_post,
        'message'=>'Page posts successfully loaded']);
     }
     
 
}

}