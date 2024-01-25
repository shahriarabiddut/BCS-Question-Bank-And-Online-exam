<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }
}
