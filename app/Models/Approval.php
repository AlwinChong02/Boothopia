<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'organiser_id',
        'requester_id',
        'event_id',
        'booth_quantity',
        'booth_ids', // Added to allow mass assignment
        'status',
        'approval_image',
        'reviewed_at',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function organiser()
    {
        return $this->belongsTo(User::class, 'organiser_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
