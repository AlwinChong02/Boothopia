<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'requester_id',
        'booth_booking_id',
        'status',
        'approval_image',
    ];
    // public function boothBooking()
    // {
    //     return $this->belongsTo(BoothBooking::class);
    // }
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
