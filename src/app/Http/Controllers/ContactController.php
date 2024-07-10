<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

use function PHPUnit\Framework\isNull;

class ContactController extends Controller
{
    public function index()
    {
        return view("contact.index");
    }   

    public function store(ContactRequest $request)
    { 
        $contact = $request->all();
        return view("contact.confirm",compact('contact'));
    }

    public function regist(Request $request)
    {
        if ($request->input("back") == "yes") {
            return redirect("/")
            ->withInput();
        }

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
        return redirect("/");
    }

    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        return view("auth.admin",compact('contacts'));
    }

    public function search(Request $request){
        if ($request->input("reset") == "yes") {
            return redirect("/admin");
        }

        $category_id = (int)$request->category_id;
        $gender_isset = $request->gender != 'null';
        $date_isset = isset($request->date);
        
        $contacts = Contact::where(function($q) use($request){
        $q->where('first_name','like',"%$request->text%")
        ->orwhere('last_name','like',"%$request->text%")
        ->orwhere('email','like',"%$request->text%");
        })
        ->where('category_id',"$request->category_id")
        ->when($gender_isset, function ($q) use ($request) {
            $gender = (int)$request->gender;
            $q->where('gender','=',$gender);
            })
        ->when($date_isset,function ($q) use ($request) {
            $q->whereDate('created_at', "$request->date");
            })
        ->Paginate(7);

        return view("auth.admin",compact('contacts'));
    }
}
