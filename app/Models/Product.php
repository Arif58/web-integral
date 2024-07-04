<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    protected $fillable = [
        'tryout_id',
        'price',
        'ie_gems',
        'features',
        'answer_explanation_file',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function tryOut()
    {
        return $this->belongsTo(TryOut::class, 'tryout_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'tryout_id', 'tryout_id');
    }
}
