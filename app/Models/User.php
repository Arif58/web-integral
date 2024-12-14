<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomVerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'email_verified_at',
        'phone',
        'level',
        'institution',
        'city_id',
        'first_major',
        'second_major',
        'interest',
        'is_completed',
        'ie_gems',
    ];

    public static $level = [
        null => 'Jenjang Sekolah',
        'sma' => 'SMA',
        'smk' => 'SMK',
        'ma' => 'MA',
        'sederajat lainnya' => 'Sederajat Lainnya',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function firstMajor()
    {
        return $this->belongsTo(Major::class, 'first_major');
    }

    public function secondMajor()
    {
        return $this->belongsTo(Major::class, 'second_major');
    }

    public function talentInterest()
    {
        return $this->belongsTo(Cluster::class, 'interest');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
}
