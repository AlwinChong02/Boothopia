<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']); 
    }

    public function index()
    {
        $currentUser = Auth::user();
        $users = User::all(); //all users data
        return view('admin.dashboard', compact('currentUser', 'users'));
    }

}
