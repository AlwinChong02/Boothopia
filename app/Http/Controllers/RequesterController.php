<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Approval;

class RequesterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:requester']);
    }

  
    public function index()
    {
        $user = Auth::user();
        // Fetch approvals where the requester_id is the current user, and eager load the event relationship
        $approvals = Approval::with('event')
            ->where('requester_id', $user->id)
            ->orderByDesc('created_at')
            ->get();
    
        return view('requester.dashboard', compact('user', 'approvals'));
    }
}
