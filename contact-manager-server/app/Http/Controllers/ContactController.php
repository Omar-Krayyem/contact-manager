<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Exception;

class ContactController extends Controller
{
    function getAll(){
        try{    
            $contact = Contact::with('user')->get();
            return $this->customResponse($contact);
        }catch(Exception $e){
            return self::customResponse($e->getMessage(),'error',500);
        }
    }

    function getById(Contact $contact){
        try{
          
            return $this->customResponse($contact->load('contact'));
        }catch(Exception $e){
            return self::customResponse($e->getMessage(),'error',500);
        }
    }

    function store(Request $request_info){
        try{   
           $validated_data = $this->validate($request_info, [
                'name' => ['required','string', 'unique:contacts'],
                'phone' => ['required','numeric'],
                'latitude' => ['required','numeric'],
                'longtude' => ['required','numeric'],
                'user_id' => ['required','exists:users,id']
            ]); 

            $contact = Contact::create($validated_data);

            return $this->customResponse($contact, 'Product Created Successfully');
        }catch(Exception $e){
            return self::customResponse($e->getMessage(),'error',500);
        }
    }

    function destroy(Contact $contact){
        try{
            $contact->delete();
            return $this->customResponse($contact, 'Deleted Successfully');
        }catch(Exception $e){
            return self::customResponse($e->getMessage(),'error',500);
        }
    }

    function update(Request $request_info){
        try{
            $contact = Contact::find($request_info->id);
            $contact->name = $request_info->name;
            $contact->phone = $request_info->phone;
            $contact->latitude = $request_info->latitude;
            $contact->longtude = $request_info->longtude;
            $contact->user_id = $request_info->user_id;
            $contact->save();

            return $this->customResponse($contact, 'Updated Successfully');
        }catch(Exception $e){
            return self::customResponse($e->getMessage(),'error',500);
        }
    }

    function customResponse($data, $status = 'success', $code = 200){
        $response = ['status' => $status,'data' => $data];
        return response()->json($response,$code);
    }
}
