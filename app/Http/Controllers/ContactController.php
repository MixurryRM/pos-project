<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //user side----------------------------------------------------
    //contact page
    public function contactPageList(){
        return view('user.main.contact');
    }

    Public function contactSent(Request $request){
        Validator::make($request->all(),[
            'message' => 'required|min:1'
        ])->validate();

        $data = User::where('id',$request->id)->first();

         $input = [
            'user_id' => $request->id,
            'name' => $data->name,
            'email' => $data->email,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ];

        Contact::create($input);

        return redirect()->back();

    }

    //admin side
    //contact page
    public function  contactlist(){

        $contact = Contact::when(request('key'),function($query){
            $query->where('name', 'LIKE', "% request('key') %")
                     ->orWhere('email', 'LIKE', "% request('key') %");})
                     ->paginate(3);

        return view('admin.contact.list',compact('contact'));
    }

    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return redirect()->back()->with(['messageDelete'=> 'User Message deleted successfully!']);
    }
}
