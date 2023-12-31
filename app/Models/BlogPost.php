<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function categories () {
        return $this->belongsTo(BlogCategory::class, 'blogcat_id', 'id');
    }

    public function users () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
