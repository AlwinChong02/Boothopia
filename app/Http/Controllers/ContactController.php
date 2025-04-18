<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\ContactModel;
use Illuminate\Support\Facades\Auth;

class ContactController extends BaseController
{

    function showContactPage(){
        return view('/contact');
    }
    
    function contact(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'description' => 'required'
        ]);
        $data = $request->input();
        $request->session()->flash('user', $data['username']);
        $request->session()->flash('message', 'feedback successfully send!');
        return redirect("/contact");
    }

    function addFeedback(Request $request){
        $ContactModel = new ContactModel();
        $created_by = Auth::user();
        $username = $request->input('username');
        $email = $request->input('email');
        $description = $request->input('description');
        $ContactModel->getUserId($created_by->id);
        $insertData = [
            'created_by' => $created_by->id,
            'name' => $username,
            'email' => $email,
            'description' => $description
        ];
        $request->validate([
            'username' => 'required | max:30',
            'email' => 'required | email',
            'description' => 'required',
        ]);
        $insertData['user_id'] = Auth::id();
        $ContactModel->insertFeedbacks($insertData);
        $request->session()->flash('message', 'Your feedback has been received. Thank you for helping us get better!');
        return redirect()->back();
    }
}