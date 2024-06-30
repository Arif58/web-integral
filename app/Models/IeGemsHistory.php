<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IeGemsHistory extends Model
{
    use HasFactory;

    protected $table = 'ie_gems_histories';

    protected $fillable = [
        'user_id',
        'type',
        'gems',
    ];
}
