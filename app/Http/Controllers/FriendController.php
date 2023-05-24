<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use App\Models\FriendRequest;

class FriendController extends Controller
{

    public function showFriends()
    {
        //These will fetch out your friends
        $users = Friend::leftJoin('users as u', 'u.id', '=', 'receiver_id')->where('sender_id', Auth::user()->id)->where('active', 1)->orderBy('friends.created_at', 'desc');

            if($users->count() == 0){
                return response()->json(['status' => 200,
                'show_friends' => 'No friends yet',
                'message'=>'successful']);
            }else{
                return response()->json(['status' => 200,
                'show_friends' => $users,
                'message'=>'successful']);
            }
       
    }

    public function sendFriendRequest(Request $request)
    {
        //These will connect to the potential friend. He will wait for friend request to be confirmed
        $users = FriendRequest::where('sender_id', $request->input('sender_id'))->where('accepter_id', $request->input('accepter_id')->where('status', 1)->count();

        if($users == 1){
            return response()->json(['status' => 200,
               'message'=>'friend request already send']);
        }else{
            $users = FriendRequest::create([
                'sender_id' => $request->input('sender_id'),
                'accepter_id' => $request->input('accepter_id'),
            ]);

            return response()->json(['status' => 200,
                'message'=>'Friends request has been sent']);
        }

    }


    public function potentialFriends()
    {
//This will bring out potential friends
//Finish this with the subquery
$users = Friend::leftJoin('users as u', 'u.id', '=', 'sender_id')->whereNotIn('sender_id', Auth::user()->id)->where('status', 1)->orWhere('u.location', Auth::user()->location)->orWhere('country', Auth::user()->country)->orderBy('friends.created_at', 'desc');

if($users->count() == 0){
    return response()->json(['status' => 200,
    'show_friend' => 'No friends request',
    'message'=>'successful']);
}else{
    return response()->json(['status' => 200,
    'show_friendss' => $users,
    'message'=>'successful']);
}

 }

 public function connectToThePotentialFriend()
 {
//This will bring out potential friends
//Finish this with the subquery
$users = Friend::leftJoin('users as u', 'u.id', '=', 'sender_id')->whereNotIn('sender_id', Auth::user()->id)->where('status', 1)->orWhere('u.location', Auth::user()->location)->orWhere('country', Auth::user()->country)->orderBy('friends.created_at', 'desc');

if($users->count() == 0){
 return response()->json(['status' => 200,
 'show_friend' => 'No friends request',
 'message'=>'successful']);
}else{
 return response()->json(['status' => 200,
 'show_friendss' => $users,
 'message'=>'successful']);
}

}

    public function searchFriendsAndOtherThings()
    {
        //To add search for pages, groups, etc latter 
        $users = User::->where('active', 1)->whereNotIn('id', Auth::user()->id);

        if($users->count() == 0){
            return response()->json(['status' => 200,
            'message'=>'No Result']);
        }else{
            return response()->json(['status' => 200,
            'show_friends' => $users,
            'message'=>'successful']);
        }
   
    }
}
