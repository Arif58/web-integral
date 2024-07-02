<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';

    protected $fillable = [
        'participant_id', 
        'question_id', 
        'test_answer_id', 
        'answer_text'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
