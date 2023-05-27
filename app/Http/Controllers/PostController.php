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

//

    }
}
}