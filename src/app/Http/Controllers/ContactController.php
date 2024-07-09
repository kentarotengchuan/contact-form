<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("contact.index");
    }   

    public function store(Request $request)
    { 
        $contact = $request->all();
        return view("contact.confirm",compact('contact'));
    }

    public function regist(Request $request)
    {
        $data = [
            "category_id" => $request->category_id*1,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "gender" => $request->gender,
            "email" => $request->email,
            "tell" => $request->first_tell."-". $request->second_tell ."-". $request->third_tell,
            "address" => $request->address,
            "building" => $request->building,
            "detail" => $request->detail,
        ];
        unset($data["_token"]);
        Contact::create($data);
        return view("contact.thanks");
    }

    public function redirect()
    {
        return view("contact.index");
    }

    public function admin(Contact $contact)
    {
        //
    }
}
