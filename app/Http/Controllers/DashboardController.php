<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function showHeaderInfo()
    {
        $userHeaderInfo = User::select('profile_picture', 'firstname', 'lastname')->where('email', Auth::user()->email)->where('active', 1)->first();
        
        return response()->json(['status' => 200,
        'profile_picture' => $userHeaderInfo,
        'message'=>'successful']);

    }


public function aPotentialFriends()
{
    $potential = Friend::count();
    if($potential == 0){
        return response()->json(['status' => 200,
         'potential_friend' => false,
         'message'=>'successful']);
    }else{
        $potential = User::select('firstname', 'lastname', 'profile_picture', 'occupation')->where('country', Auth::user()->country)->whereNotIn('id', Auth::user()->id)->where('active', 1)->orderBy('created_at', 'desc')->limit(1)->get();

        return response()->json(['status' => 200,
        'potential_friend' => $potential,
        'message'=>'successful']);

    }

 


//This will bring out potential friends
//Finish this with the subquery and this should be a smarter query

// $ifAddFriend = Friend::where('sender_id', Auth::user()->id)->where('status', 1)->count();
// if($ifAddFriend == 0){

// $findFriend = Friend::where('receiver_id', Auth::user()->id)->count();
// if($findFriend == 0){
// $potential = User::select('firstname', 'lastname', 'profile_picture', 'occupation')->where('country', Auth::user()->country)->whereNotIn('id', Auth::user()->id)->where('active', 1)->orderBy('friends.created_at', 'desc')
// ->limit(1)->get();

// return response()->json(['status' => 200,
//     'potential_friend' => $potential,
//     'message'=>'successful']);
// }else{

//     $people_who_wants_to_be_friends = Friend::select('sender_id')->where('receiver_id', Auth::user()->id)->lists('id')->all();

//     $potential = Friend::select('firstname','profile_picture', 'lastname', 'occupation')->leftJoin('users as u', 'u.id', '=', 'sender_id')->where('receiver_id', $people_who_wants_to_be_friends)->orderBy('friends.created_at', 'desc')
//     ->limit(1)->get(); //I need to confirm this well so users table does to overlap.
    
//     return response()->json(['status' => 200,
//     'potential_friend' => $potential,
//     'message'=>'successful']);

// }

// }else if($ifAddFriend > 0){

//     $people_who_wants_to_be_friends = Friend::select('receiver_id')->where('sender_id as sendid', Auth::user()->id)->lists('sendid')->all();

//     $potential = Friend::select('firstname', 'profile_picture','lastname', 'occupation')->leftJoin('users as u', 'u.id', '=', 'reciever_id')->where('receiver_id', $people_who_wants_to_be_friends)->orderBy('friends.created_at', 'desc')
//     ->limit(1)->get(); //I need to confirm this well so users table does to overlap.

//     return response()->json(['status' => 200,
//     'potential_friend' => $potential,
//     'message'=>'successful']);

// }else{
// $potential = Friend::count();
// if($potential == 0){
//     return response()->json(['status' => 200,
//     'potential_friend' => $potential,
//     'message'=>'successful']);

// }else{

//     $potential = User::select('firstname', 'lastname', 'profile_picture', 'occupation')->where('country', Auth::user()->country)->whereNotIn('id', Auth::user()->id)->where('active', 1)->orderBy('created_at', 'desc')->limit(1)->get();

//     return response()->json(['status' => 200,
//     'potential_friend' => $potential,
//     'message'=>'successful']);

// }

   
// }



 }

 public function userImageProfile(){
    $profilePicture = User::select('profile_picture', 'firstname', 'lastname')->where('id', Auth::user()->id)->where('active', 1)->first();

    return response()->json(['status' => 200,
    'profile_picture' =>$profilePicture,
    'message'=>'successful']);
 }



 public function createPost(Request $request){
       
    $validator = Validator::make($request->all(), [
    'post'=>'nullable',
    'visible_post_for'=>'nullable',
    'image'=>'nullable',
    'image_path'=>'nullable',
    'video'=>'nullable',
    'video_path'=>'nullable',
    ]);

    if($validator->fails()){
        return response()->json([
    'validator_errors'=> $validator->messages()
        ]);
    }else{

//

}
}



}
