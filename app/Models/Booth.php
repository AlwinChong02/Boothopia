<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'img', 'price', 'event_id', 'user_id'
    ];

    // Define the inverse relationship: a booth belongs to an event.
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
