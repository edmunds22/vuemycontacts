<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Contact as Contact;
use \App\User as User;
use Validator;

/**
 * General functionality around fetching and updating contacts
 *
 * @category Controllers
 * @package  VueContacts
 * @author   WP Edmunds <will@wpedmunds.uk>
 * @link     http://wpedmunds.uk
 */
class ContactsController extends Controller
{

    /**
     * Fetch user id by token
     *
     * @param   String  $token
     *
     * @return  $id integer - the users id
     */
    private function getUserId($token){
        $user = User::where([
            'token' => $token
        ])->first();
        return $user->id;
    }

    /**
     * Fetch contacts
     *
     * @param   Request  $request
     *
     * @return  json list of user's stored contacts
     */
    function list(Request $request)
    {
        $userId = self::getUserId($request->token);
        $contacts = User::where('token', $request->token)->first()->contacts;
        return response()->json([
            'contacts' => $contacts
        ]);
    }

    /**
     * Create new contact endpoint
     *
     * @param   Request  $request
     *
     * @return  json success status and possibly a message bag
     */
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

    /**
     * Fetch an individual contact
     *
     * @param   Request  $request
     * @param  $id Int   Fetching contact id
     *
     * @return  json contact object
     */
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

    /**
     * Update a stored contact
     *
     * @param   Request  $request
     * @param   Int $id Id of the contact to be updated
     *
     * @return  json success status
     */
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