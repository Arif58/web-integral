<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTest extends Model
{
    use HasFactory;

    protected $table = 'sub_tests';

    protected $fillable = [
        'category_subtest_id',
        'try_out_id',
        'name',
        'total_question',
        'duration',
    ];

    public function categorySubtest()
    {
        return $this->belongsTo(CategorySubtest::class, 'category_subtest_id');
    }

    public function tryOut()
    {
        return $this->belongsTo(TryOut::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
