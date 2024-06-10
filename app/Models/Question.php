<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_test_id',
        'type',
        'question_text',
        'difficulty_parameter',
        'question_image',
    ];

    public function subTest()
    {
        return $this->belongsTo(SubTest::class);
    }

    public function questionChoices()
    {
        return $this->hasMany(TestAnswer::class);
    }
}
