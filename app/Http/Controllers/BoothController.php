<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booth;

class BoothController extends Controller
{
    public function index()
    {
        $booths = Booth::all(); // Fetch all booths from the database
        return view('booths.index', compact('booths'));
    }

    
}