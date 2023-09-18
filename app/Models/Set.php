<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    function questions()
    {
        return $this->hasMany(QuestionSet::class, 'set_id');
    }
}
