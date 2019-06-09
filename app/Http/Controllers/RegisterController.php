<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class RegisterController extends Controller
{
    //
    function register(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'max:150',
            'password' => 'max:150',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'validator' => $validator->getMessageBag()->toArray()
            ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        
        return response()->json([
            'status' => 'success'
        ]);

    }

    function login(Request $request)
    {
        $user = User::where([
            'email' => $request->email
        ])->first();
        
        if($user && Hash::check($request->password, $user->password)){
            $token = uniqid();
            $user->token = $token;
            $user->save();
            return response()->json([
                'success' => true,
                'token' => $token
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}