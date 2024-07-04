<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryOut extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'try_outs';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'is_grading_completed',
    ];

    public function subTests()
    {
        return $this->hasMany(SubTest::class);
    }
   
    public function product() {
        return $this->hasOne(Product::class);
    }
}
