<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StoreManager extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'user_id',
        'role',
    ];

    protected $hidden = ['password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function shops()
    {
        return $this->hasMany(Shop::class,'manager_id');
    }
    
}
