<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'participants';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tryOut()
    {
        return $this->belongsTo(TryOut::class, 'tryout_id');
    }

    protected $casts = [
        'start_test' => 'datetime',
        'end_test' => 'datetime',
    ];
}
