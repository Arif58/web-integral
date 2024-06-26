<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAchievement extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_achievements';

    protected $fillable = [
        'name',
        'achievement',
        'school',
        'photo',
        'highlighted_order',
    ];

}
