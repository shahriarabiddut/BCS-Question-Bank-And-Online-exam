<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }
    function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
