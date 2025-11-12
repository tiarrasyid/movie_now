<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_id';
    protected $fillable = [
        'movie_name',
        'movie_rating',
        'movie_date',
        'description',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class, 'movie_id', 'movie_id');
    }
}

