<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreManager extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'shop_id'];

    protected $hidden = ['password'];
    
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
