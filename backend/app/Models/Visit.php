<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\VisitsStatus;
use App\Models\Visitor;

class Visit extends Model
{
    protected $fillable = ['visitor_id', 'user_id', 'access_card_id' , 'entered_at', 'exited_at' , 'status'];

    public function visitor() 
    {
        return $this->belongsTo(Visitor::class);
    }

    public function accessCard() {
        return $this->belongsTo(AccessCard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'status' => VisitsStatus::class,
        ];
    }

}

// Statuses:

// CREATED

// APPROVED

// DENIED

// CHECKED_IN

// CHECKED_OUT
