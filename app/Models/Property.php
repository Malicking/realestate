<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Types () {
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }

    public function Users () {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function States () {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
