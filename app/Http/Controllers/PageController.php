<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Event;
use App\Models\PagePost;
use App\Models\PageAdmin;
use App\Models\PageMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PageGeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Coduo\PHPHumanizer\NumberHumanizer;


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

                DB::table('page_admins')->insert(
                    ['page_id' => $page->id, 'user_id' => Auth::user()->id, 'page_admin_roles_id'=>'1','created_at' => Carbon::now(),'updated_at' => Carbon::now()]
                );

                return response()->json(['status' => 200,
                'message'=>'Successful']);

                 
            }    
    }



    public function showPageList(){
        $pages = PageMember::leftJoin('pages', 'pages.id', '=', 'page_members.page_id')->leftJoin('page_category_types', 'page_category_types.id', '=', 'pages.page_category')->select('page_members.id', 'pages.page_name', 'page_category_types.page_category', 'pages.page_description', 'pages.cover_picture', 'pages.created_at')->where('page_members.user_id', Auth::user()->id)->orderByDesc('page_members.created_at')->paginate(12);
        
        
    return response()->json([
            'status' => 200,
            'pages'=> $pages,
           'message' => 'successful',
           
        ]);
       }


     public function showPageCover($id){
            //I own the page
        $find_page = Page::leftJoin('page_privacy_types', 'page_privacy_types.id', '=', 'pages.page_privacy_types_id')->leftJoin('page_category_types', 'page_category_types.id', "=", "pages.page_category")->select('page_name', 'cover_picture','profile_picture', 'page_privacy', 'page_contact', 'page_whatsapp', 'page_email', 'page_website', 'pages.created_at', 'page_description', 'page_category_types.page_category')->where('pages.id', $id)->where('pages.user_id', Auth::user()->id);
        if($find_page->count() == 1){
        $users = $find_page->get();
        $members = PageMember::where('page_id', $id)->count();
        
        
        return response()->json([
            'status' => 200,
            'page'=> $users,
            'member_count'=>NumberHumanizer::metricSuffix($members),
            'page_admin'=>true,
            'message' => 'successful',
        ]);

     }else{
        //I belong to the page
        $members = PageMember::where('page_id', $id)->where('page_members.user_id', Auth::user()->id);
        if($members->count() == 1){
            $users = $find_page->get();
            $members = PageMember::where('page_id', $id)->count();

            return response()->json([
                'status' => 200,
                'page'=> $users,
                'member_count'=>NumberHumanizer::metricSuffix($members),
                'page_admin'=>false,
               'message' => 'successful',
               
            ]);
        }else{
            //I do not own or belong to this page
            $find_page = Page::leftJoin('page_privacy_types', 'page_privacy_types.id', '=', 'pages.page_privacy_types_id' )->where('pages.id', $id)->get();
            $members = PageMember::where('page_id', $id)->count();

            return response()->json([
                'status' => 200,
                'page'=> $users,
                'member_count'=>NumberHumanizer::metricSuffix($members),
                'page_admin'=>false,
               'message' => 'successful',
               
            ]);
        }
     }

//Post


    }

    public function showAboutPageContent($id){
        
     $pageabout = Page::leftJoin('page_category_types', 'page_category_types.id', '=', 'pages.page_category')->select('page_category_types.page_category','page_description', 'page_email', 'page_contact', 'page_website', 'pages.created_at')->where('pages.id', $id)->get();
  
         return response()->json(['status' => 200,
         'pageabout'=> $pageabout,
        'message'=>'Successful']);
     
    }


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