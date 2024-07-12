<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

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

    public function admin(){
        $search_text = session()->get('old_search_text','');
        $search_category = session()->get('old_search_category','null');
        $search_gender = session()->get('old_search_gender','null');
        $search_date = session()->get('old_search_date',null);

        $category_isset = $search_category != 'null';
        $gender_isset = $search_gender != 'null';
        $date_isset = isset($search_date); 

        $contacts = Contact::with('category')
        ->where(function ($q) use ($search_text) {
            $q->where('first_name', 'like', "%$search_text%")
            ->orwhere('last_name', 'like', "%$search_text%")
            ->orwhere('email', 'like', "%$search_text%");
        })
        ->when($category_isset, function ($q) use ($search_category) {
            $category = (int)$search_category;
            $q->where('category_id', '=', $category);
        })
        ->when($gender_isset, function ($q) use ($search_gender) {
            $gender = (int)$search_gender;
            $q->where('gender', '=', $gender);
        })
        ->when($date_isset, function ($q) use ($search_date) {
            $q->whereDate('created_at', "$search_date");
        })
        ->Paginate(7);
        return view("auth.admin", compact('contacts'));
    }

    public function reset(Request $request)
    {   
        $request->session()->forget('old_search_text');
        $request->session()->forget('old_search_category');
        $request->session()->forget('old_search_gender');
        $request->session()->forget('old_search_date');
        
        return redirect("/admin");
    }

    public function search(Request $request){

        if ($request->input("reset") == "yes") {
            return redirect("/admin/reset");
        }

        $request->session()->put([
            'old_search_text'=>$request->text,
            'old_search_category'=>$request->category_id,
            'old_search_gender'=>$request->gender,
            'old_search_date'=>$request->date
        ]);

        return redirect("/admin");
    }

    public function destroy(int $id){
        Contact::find($id)->delete();
        
        return redirect("/admin");
    }

    public function export(Request $request){

        $callback = function () {

            $createCsvFile = fopen('php://output', 'w');
            fwrite($createCsvFile, pack('C*', 0xEF, 0xBB, 0xBF));
            $columns = ['ID','名前','性別','メールアドレス','電話番号','住所','建物名','お問い合わせの種類','お問い合わせ内容','作成日時','更新日時'];

            fputcsv($createCsvFile, $columns);
            $search_text = session()->get('old_search_text', '');
            $search_category = session()->get('old_search_category', 'null');
            $search_gender = session()->get('old_search_gender', 'null');
            $search_date = session()->get('old_search_date', null);

            $category_isset = $search_category != 'null';
            $gender_isset = $search_gender != 'null';
            $date_isset = isset($search_date);

            $contacts = Contact::with('category')
                ->where(function ($q) use ($search_text) {
                $q->where('first_name', 'like', "%$search_text%")
                ->orwhere('last_name', 'like', "%$search_text%")
                ->orwhere('email', 'like', "%$search_text%");
                })
                ->when($category_isset, function ($q) use ($search_category) {
                $category = (int)$search_category;
                $q->where('category_id', '=', $category);
                })
                ->when($gender_isset, function ($q) use ($search_gender) {
                $gender = (int)$search_gender;
                $q->where('gender', '=', $gender);
                })
                ->when($date_isset, function ($q) use ($search_date) {
                $q->whereDate('created_at', "$search_date");
                })
                ->get();

            foreach ($contacts as $row) {
                $csv = [
                    $row->id,
                    $row->last_name.$row->first_name,
                    $row->gender,
                    $row->email,
                    $row->tell,
                    $row->address,
                    $row->building,
                    $row->category_id,
                    $row->detail,
                    $row->created_at,
                    $row->updated_at,
                ];

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };

        return response()->stream($callback, 200, [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=csvexport.csv",]);
    }
}
