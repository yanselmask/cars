<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function listing()
    {
        return $this->hasOne(Listing::class, 'id','listing_id');
    }

    public function scopeWithDate()
    {
        return $this->whereNotNull('booking_date');
    }

    public function scopeWithoutDate()
    {
        return $this->whereNull('booking_date');
    }
}
