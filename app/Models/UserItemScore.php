<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItemScore extends Model
{
    use HasFactory;

    protected $table = 'user_item_scores';

    protected $fillable = [
        'participant_id',
        'question_id',
        'score',
    ];
}
