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
        $booths = Booth::all();
        return view('booths.index', compact('booths'));
    }

    public function getBoothById($id) //fetch single booth ONLY
    {
        return Booth::findOrFail($id);
    }
    // Create a new booth (Create)
    public function createBooth($data)
    {
        return Booth::create($data);
    }

    public function updateBooth($id, $data)
    {
        $booth = Booth::findOrFail($id);
        $booth->update($data);
        return $booth;
    }
    // Delete a booth (Delete)
    public function deleteBooth($id)
    {
        $booth = Booth::findOrFail($id);
        $booth->delete();
        return true;
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
