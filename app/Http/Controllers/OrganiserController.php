<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrganiserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:organiser']);
    }

    public function index()
    {
        $user = Auth::user();
        return view('organiser.dashboard', compact('user'));
    }
}
