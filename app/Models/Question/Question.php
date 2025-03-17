<?php

namespace App\Models\Question;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
        protected $fillable = ['product_id', 'user_id', 'question', 'name'];
 
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function answers()
        {
            return $this->hasMany(Answer::class);
        }
}
