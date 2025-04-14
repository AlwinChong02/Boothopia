<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'img', 'price'];


    public function index()
    {
        // Fetch all booths from the database
        $booths = Booth::all();

        // Pass the data to the view
        return view('booths.index', compact('booths'));
    }

    
}
