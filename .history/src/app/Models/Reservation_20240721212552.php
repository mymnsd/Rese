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
    ];

    protected $dates = [
        'start_at',
    ];

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);
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
