<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:requester']);
    }

    public function index()
    {
        $user = Auth::user();
        return view('requester.dashboard', compact('user'));
    }
}
