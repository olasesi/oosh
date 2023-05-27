<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Event;
use App\Models\PagePost;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
