<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'majors';

    protected $fillable = [
        'university_id',
        'cluster_id',
        'name',
        'passing_grade',
    ];

    public function cluster()
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
}
