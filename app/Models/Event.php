<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status', 'img', 'start_date', 'end_date',
        'start_time', 'end_time', 'location', 'category', 'booth_quantity', 'user_id'
    ];

    // Define the one-to-many relationship: an event has many booths.
    public function booths()
    {
        return $this->hasMany(Booth::class);
    }
}
