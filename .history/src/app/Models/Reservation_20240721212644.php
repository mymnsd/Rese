<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'user_id',
        'guest_count',
        'start_at',
        'status',
    ];

    protected $dates = [
        'start_at',
    ];

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);
    }

    // 状態が 'completed' の場合のみレビューを許可するメソッド
    public function canReview()
    {
        return $this->status === 'completed' && $this->start_at < now();
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
