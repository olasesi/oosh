<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SignupRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createRegister()
    {
        return view('auth.register');
    }


    public function saveRegister(Request $request)
    {

           $countRegistered = User::where('email', $request->input('email'))->where('active', 1)->count();
         if($countRegistered == 1){
             return response()->json(['status' => 500,'message'=>'already a user',
            'email'=>$request->input('email')]);
         }

            $validator = Validator::make($request->all(), [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'date_of_birth'=>'nullable',
            'gender'=>'nullable'  
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

    public function saveLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
             ]);

         if($validator->fails()){
            return response()->json([
        'validator_errors'=> $validator->messages()
            ]);
        }else{


            //$remember_me = $request->has('remember_token') ? true : false;
          if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1])) {
             $request->session()->regenerate();
             
             $user = User::select('email', 'firstname', 'lastname', 'phone', 'date_of_birth', 'gender', 'profile_picture', 'username', 'location', 'country', 'website', 'bio', 'cover_photo', 'occupation')->where('active', 1)->where('id', Auth::user()->id)->get();

             $token = $user->createToken($user->email.'_token')->plainTextToken;

             return response()->json(['status' => 200,
            'users'=> $user,
            'message'=>'Login was successful']);
         }else{
            return response()->json(['status' => 401,
            'message'=>'Invalid credentials']);

         }

    }
  
    }

    public function verifyEmail($token) { 
        
        $verify_user = User::where('verification_code', $token)->count();
        if($verify_user == 1){
            
            $verify = User::where('verification_code', $token)->first();
            $verify->active = 1;
            $verify->verification_code = '';
            $verify->save();

            //Deleting other registrations of the same user and token on the personal token
            $getColumn = User::select('email')->where('verification_code', $token)->get();
            $deleteRows = User::where('email',$getColumn)->where('active', 0)->delete();

            //  $getTokenColumn =DB::table('personal_access_tokens')->where('name', $getColumn.'_token')->orderBy("id", "DESC")->take(1)->delete();
            //I need to be able to delete all rows before the last added

            return response()->json(['status' => 200,
            'message'=>'User email has now been confirmed']);
            }else{
                return response()->json(['status' => 500,
                'message'=>'Invalid']);
            }
        
            
        }

      public function forgetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
             ]);

             if($validator->fails()){
                return response()->json([
            'validator_errors'=> $validator->messages()
                ]);
            }else{
                $countForgotPassword = User::where('email', $request->input('email'))->where('active', 1)->count();
                if($countForgotPassword == 1){
                    $randomToken = random_int(100000, 999999);
                    $email_verification = Str::random(30);

                    $passwordReset = User::select('email')->where('active', 1)->first();
                    $passwordReset->forget_password = $email_verification;
                    $passwordReset->save();
        

                    $email_verification_code = ['verification_string'=>$email_verification,'token'=> $randomToken, 'email'=>$request->input('email') ];
                    Mail::to($request->input('email'))->send(new ForgetPassword($email_verification_code));


                }else{

                    return response()->json(['status' => 500,
                    'message'=>'Invalid']);
                }

            }

public function logout(){

    auth()->user()->tokens()->delete();

    return response()->json(['status' => 500,
                    'message'=>'Invalid']);
}




      }






 //    public function login()
  //    {
//          return view('auth.login');
//      }


//  public function saveLogin(Request $request)
//      {
//          $validatedData = $request->validate([
//              'email' => 'nullable',
//             'password'=> 'nullable',
//             'remember_token'=>'nullable'
//              ]
//           );


//           $remember_me = $request->has('remember_token') ? true : false;
//            if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password'], 'active' => 1])) {
//               $request->session()->regenerate();
    
//               dd('works');
//           }else{
//               return response()->json('Login failed');
           
//           }
    

      
      

//      }



}
