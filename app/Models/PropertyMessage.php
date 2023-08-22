<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMessage extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function users () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    } // fin de la fonction 

    public function properties () {
        return $this->belongsTo(Property::class, 'user_id', 'id');
    } // fin de la fonction 
}
