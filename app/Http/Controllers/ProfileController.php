<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showShowProfile(Request $request)
 {

 //This fetches user profile
 $users = User::where('email', $request->input('email'))->where('status', 1)->count();

 if($users == 1){
     return response()->json(['status' => 200,
     'users'=> $users,
    'message'=>'User successfully fetched']);
 }else{
    
     return response()->json(['status' => 401,
         'message'=>'Invalid credentials']);
 }

}


public function editProfile(Request $request)
{
//What will happen when a user decides to change mail
    $validator = Validator::make($request->all(), [
        'firstname'=>'required',
        'lastname'=>'required',
        'username'=>'required',
        'email'=>'email',
        'date_of_birth'=>'nullable',
        'phone'=>'nullable',
        'gender'=>'nullable',
        'occupation'=> 'nullable',
        'zipcode'=> 'nullable',
        'education'=> 'nullable',
        'city'=> 'nullable',
        'state'=> 'nullable',
        'address'=> 'nullable', 
        'bio'=> 'nullable', 
        ]);

        if($validator->fails()){
            return response()->json([
        'validator_errors'=> $validator->messages()
            ]);
        }else{

$randomToken = random_int(100000, 999999);
$email_verification = Str::random(30);

$user = User::create([
    'email' => $request->input('email'),
    'firstname' => $request->input('firstname'),
    'lastname' => $request->input('lastname'),
    'username' => $request->input('username'),
    'date_of_birth' => $request->input('date_of_birth'),
    'gender' => $request->input('gender'),
    'phone' => $request->input('phone'),
    'occupation' => $request->input('occupation'),
    'zipcode' => $request->input('zipcode'),
    'education' => $request->input('education'),
    'city' => $request->input('city'),
    'state' => $request->input('state'),
    'address' => $request->input('address'),
    'bio' => $request->input('bio'),
    
]);

//$token = $user->createToken($user->email.'_token')->plainTextToken;

//$email_verification_code = ['verification_string'=>$email_verification,'token'=> $randomToken, 'email'=>$request->input('email') ];
//Mail::to($request->input('email'))->send(new SignupRegistration($email_verification_code));

return response()->json(['status' => 200,
'user' => $user, 
'message'=>'Profile was successful edited']);

}

}



}