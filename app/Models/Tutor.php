<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tutors';

    protected $fillable = [
        'photo',
        'name',
        'position',
        'education',
        'highlighted_order',
    ];
}
