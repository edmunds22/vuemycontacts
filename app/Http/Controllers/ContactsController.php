<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Contact as Contact;
use \App\User as User;
use Validator;

class ContactsController extends Controller
{

    private function getUserId($token){
        $user = User::where([
            'token' => $token
        ])->first();
        return $user->id;
    }
    //
    function list(Request $request)
    {

        $userId = self::getUserId($request->token);
        $contacts = User::where('token', $request->token)->first()->contacts;
        return response()->json([
            'contacts' => $contacts
        ]);
    }

    function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'email' => 'max:150',
            'phone' => 'max:150',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'validator' => $validator->getMessageBag()->toArray()
            ]);
        }

        $userId = self::getUserId($request->token);

        $contact = new Contact;
        $contact->full_name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->user_id = $userId;

        $contact->save();
        
        return response()->json([
            'status' => 'success'
        ]);

    }

    function fetch(Request $request, $id)
    {

        $userId = self::getUserId($request->token);

        $contact = Contact::where([
            'id' => $id,
            'user_id' => $userId
        ])->first();
        return response()->json([
            'contact' => $contact
        ]);
    }

    function update(Request $request, $id)
    {

        $userId = self::getUserId($request->token);
        
        $contact = Contact::where([
            'id' => $id,
            'user_id' => $userId
        ])->first();
        $contact->full_name = $request->full_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;

        $contact->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }

}