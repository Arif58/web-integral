<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedSubtest extends Model
{
    use HasFactory;

    protected $table = 'completed_subtests';

    protected $fillable = [
        'participant_id',
        'sub_test_id',
        'completed_at',
        'started_at',
        'score',
        'status',
    ];
}
