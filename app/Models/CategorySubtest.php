<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubtest extends Model
{
    use HasFactory;

    protected $table = 'category_subtests';

    protected $fillable = [
        'name',
    ];
}
