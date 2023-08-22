<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function properties () {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}

