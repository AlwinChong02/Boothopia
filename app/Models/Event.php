<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function booths()
    {
        return $this->hasMany(Booth::class);
    }
    protected $fillable = [
        'name', 'description', 'status', 'img', 'start_date', 'end_date',
        'start_time', 'end_time', 'location', 'category', 'booth_quantity', 'user_id'
    ];
}
