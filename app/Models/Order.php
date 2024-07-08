<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Mengubah waktu menjadi GMT+7 ketika mengambil dari database
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }

    public function getExpiredAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Jakarta');
    }
}
