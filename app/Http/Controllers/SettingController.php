<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    public function editSetting(){

        $user = User::where('id', Auth::user()->id)->where('active', 1)->first();

        return response()->json(['status' => 200,
        'user'=> $user,
        'message'=>'Successful']);

    }


    public function updateSetting(Request $request){

        $validator = Validator::make($request->all(), [
            'firstname'=>'nullable',
            'lastname'=>'nullable',
            'username'=>'nullable',
            'email'=>'nullable',
            'date_of_birth'=>'nullable',
            'phone'=>'nullable',
            'occupation'=>'nullable',
            'gender'=>'nullable',
            'website'=>'nullable',
            'zipcode'=>'nullable',
            'city'=>'nullable',
            'state'=>'nullable',
            'address'=>'nullable',
            'hobby'=>'nullable',
            'bio'=>'nullable',
            ]);

            if($validator->fails()){
                return response()->json([
            'validator_errors'=> $validator->messages(),
                ]);
            }else{

                $user = User::where('id', Auth::user()->id)->where('active', 1);
                $user->firstname = $request->input('firstname');
                $user->lastname = $request->input('lastname');
                $user->username = $request->input('username');
                $user->email = $request->input('email');
                $user->date_of_birth = $request->input('date_of_birth');
                $user->phone = $request->input('phone');
                $user->occupation = $request->input('occupation');
                $user->gender = $request->input('gender');
                $user->website = $request->input('website');
                $user->zipcode = $request->input('zipcode');
                $user->city = $request->input('city');
                $user->state = $request->input('state');
                $user->address = $request->input('address');
                $user->hobby = $request->input('hobby');
                $user->bio = $request->input('bio');
                $user->save();

                return response()->json(['status' => 200,
                
                'message'=>'User settings updated']);


            }



    }
}
