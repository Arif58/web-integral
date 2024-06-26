<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonies';

    protected $fillable = [
        'name',
        'major',
        'testimonials',
        'photo',
        'highlighted_order',
    ];
}
