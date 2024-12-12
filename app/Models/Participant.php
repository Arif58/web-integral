<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function userScores()
    {
        return $this->hasMany(UserItemScore::class, 'participant_id');
    }

    protected $casts = [
        'start_test' => 'datetime',
        'end_test' => 'datetime',
    ];

    public function getStartTestAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }
}
