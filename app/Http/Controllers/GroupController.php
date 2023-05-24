<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function showAboutGroup($id){
        //This will pull out a list of groups
     $groups = Group::orderBy('created_at', 'desc')->take(7)->get();
         if($users->count() == 0){
             return response()->json(['status' => 200,
            
            'message'=>'No groups yet']);
         }else{
             return response()->json(['status' => 200,
             'groups'=> $groups,
            'message'=>'Groups successfully loaded']);
         }
         
     
    }
}
