<?php

namespace App\Models\Question;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     protected $fillable = ['question_id', 'user_id', 'answer', 'is_admin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
