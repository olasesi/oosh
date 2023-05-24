<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
       
           $validator = Validator::make($request->all(), [
           'title'=>'required',
           'description'=>'required',
          
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
       'password' => Hash::make($request->input('password')),
       'date_of_birth' => $request->input('date_of_birth'),
       'gender' => $request->input('gender'),
       'verification_code' => $email_verification,
   ]);

   $token = $user->createToken($user->email.'_token')->plainTextToken;
  
   $email_verification_code = ['verification_string'=>$email_verification,'token'=> $randomToken, 'email'=>$request->input('email') ];
   Mail::to($request->input('email'))->send(new SignupRegistration($email_verification_code));


   return response()->json(['status' => 200,
   'email' => $user->email,
   'token'=>$token, 
   'message'=>'Registration was successful']);

    }
}
