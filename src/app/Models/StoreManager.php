<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class StoreManager extends Model
class StoreManager extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'shop_id',
        'role',
    ];

    protected $hidden = ['password'];
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
        
    }
}
