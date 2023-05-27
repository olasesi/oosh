<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Friend;
use App\Models\GroupPost;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

public function groupCoverInfo($id){
    $fetchGroupCoverInfo = Group::where('id',$id)->get();   //The get general group info
    $findUserInGroup = GroupMember::where('group_id',$id)->where('user_id', Auth::user()->id)->count(); //To know if a user can join
    $findTotalMember = GroupMember::where('group_id',$id)->count();

    return response()->json(['status' => 200,
             'groups'=> [$fetchGroupCoverInfo, $findUserInGroup, $findTotalMember],
            'message'=>'Groups cover info successfully loaded']);
}


    public function showSingleAboutGroup($id){
        //This will pull out a about of a single group
     $groups = Group::where('id', $id)->get();
     $groups_member = GroupMember::where('group_id', $id)->count();


     $groups_admin = GroupAdmin::select('profile_picture', 'firstname', 'lastname')->leftJoin('groups as g', 'gar.id', '=', 'group_admins.group_id')->leftJoin('group_admin_roles as gar', 'gar.id', '=', 'group_admin_role_id')->leftJoin('users as u', 'u.id', '=', 'group_admins.user_id')->where('group_id', $id)->take(1)->get(); 
    
    $date = new DateTime();
    $time_from_yesterday = $date->setTimestamp(strtotime('yesterday midnight'));
    $post_from_yesterday_count = GroupPost::where(Carbon::now() > $time_from_yesterday)->count();
    //To find other activities about the page on facebook like "+200 memebers in the last week
             return response()->json(['status' => 200,
             'groups'=> [$groups,$groups_member,$groups_admin],
            'message'=>'Groups successfully loaded']);
         
    }

public function createGroup(Request $request){

    $validator = Validator::make($request->all(), [
        'group_name'=>'required',       //perhaps to add more fields
        'group_description'=>'required',
       
        ]);

        if($validator->fails()){
            return response()->json([
        'validator_errors'=> $validator->messages()
            ]);
        }else{

//confirm that you can only create another group other than the one you have created yourself. Meaning that you cant recreate a group
   
$user = Group::create([
    'group_name' => $request->input('group_name'),
    'group_description' => $request->input('group_description'),
     'user_id'=>Auth::user()->id,
    //'user_name'=>'' To add a package that creates username randomly
]);

//Add owner to group admin
$group = GroupAdmin::create([
    'group_id' => $user->user_id,
    'user_id' => Auth::user()->id,
    'role' => 1,
]);

return response()->json(['status' => 200,
 'message'=>'Group was successfully created']);
}
}

public function editGroup($id){

    $groups = Group::where('id',$id)->get();
    return response()->json(['status' => 200,
    'group_info'=> $groups,
    'message'=>'Group selected successfully']);
}

public function updateGroup(Request $request, $id){

    $validator = Validator::make($request->all(), [
        'group_name'=>'required',
        'group_description'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
        'validator_errors'=> $validator->messages()
            ]);
        }else{
            $update_group = Group::where('id', $id);
            $update_group->group_name = input('group_name');
            $update_group->group_description = input('group_description');  //Other columns to be added later
            $update_group->save();
    
        return response()->json(['status' => 200,
        'message'=>'Group info edited successfully']);
        }

}

//public function deleteGroup($id){

//Suspended for now 


//}  

public function showGroupPostPage($id){


}


public function createGroupPost(Request $request){
       //For be done when the "short video, emotion, etc are done"
        $validator = Validator::make($request->all(), [
        'title'=>'required',
        'description'=>'required',
       
        ]);

        if($validator->fails()){
            return response()->json([
        'validator_errors'=> $validator->messages()
            ]);
        }else{

//
 }
}


public function showListAboutGroup(){
    //This will pull out a list of groups
 $groups = GroupMember::leftJoin('groups as gr', 'gr.id', '=', 'group_id')->whereNotIn('user_id', Auth::user()->id)->leftJoin('users as u', 'id', '=', 'group_members.user_id')->orderBy('created_at', 'desc'); //May be ordering can be done also based on the location, state, etc.
     
 if($groups->count() == 0){
         return response()->json(['status' => 200,
        'message'=>'No groups yet']);
     }else{
$groups_take = $groups->take(7)->get();
         return response()->json(['status' => 200,
         'groups'=> $groups_take,
        'message'=>'Groups successfully loaded']);
     }
}


public function showGroupPost(){
    //This will pull out a list of group post
    //Know how to handle large lists and pagination
 $group_post = GroupPost::orderBy('created_at', 'desc')->take(10)->get();
     if($users->count() == 0){
         return response()->json(['status' => 200,
        
        'message'=>'No Group Post']);
     }else{
         return response()->json(['status' => 200,
         'group_post'=> $page_post,
        'message'=>'Group posts successfully loaded']);
     }
}

    public function showMorePotentialFriends()
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


 public function showRelatedGroupList(){
    //This will pull out a list of related groups
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

public function showPopularMembers()
{
//This will bring out PopularMembers
//Finish this with the subquery
$users = Group::leftJoin('users as u', 'u.id', '=', 'sender_id')->whereNotIn('sender_id', Auth::user()->id)->where('status', 1)->orWhere('u.location', Auth::user()->location)->orWhere('country', Auth::user()->country)->orderBy('friends.created_at', 'desc');

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

public function showGroupAdmin()
{
//This will bring out GroupAdmin

$users = GroupMember::leftJoin('users as u', 'u.id', '=', 'user_id')->orderBy('group_admins.created_at', 'desc');

return response()->json(['status' => 200,
'show_admins' => $users,
'message'=>'successful']);


}



}
