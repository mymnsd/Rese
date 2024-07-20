<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'description',
        'image_url'
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function isFavorite()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function scopeArea(Builder $query,$area){
        if($area){
            return $query->whereHas('area',function($query)use($area){
                $query->where('name',$area);
            });
        }
        return $query;
    }

    public function scopeGenre(Builder $query,$genre){
        if($genre){
            return $query->whereHas('genre',function($query)use($genre){
                $query->where('name',$genre);
            });
        }
    }

    public function scopeKeyword(Builder $query,$keyword){
        if($keyword){
            return $query->where('name','LIKE',"% $keyword %")
            ->orWhere('description', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

    
}
