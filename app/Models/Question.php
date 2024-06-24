<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'sub_test_id',
        'type',
        'question_text',
        'difficulty_parameter',
        'question_image',
    ];

    public static $types = [
        'pilihan_ganda' => 'Pilihan Ganda',
        'pilihan_ganda_majemuk' => 'Pilihan Ganda Majemuk',
        'pernyataan' => 'Pernyataan',
        'isian_singkat' => 'Isian Singkat',
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
