<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['full_name', 'passport_number', 'phone'];

    public function visits() {
        return $this->hasMany(Visit::class);
    }

}
