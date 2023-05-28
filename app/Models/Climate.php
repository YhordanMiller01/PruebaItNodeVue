<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Climate extends Model
{
    protected $table = 'climate';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'lon',
        'lat',
        'temp',
        'feels_like',
        'temp_min',
        'temp_max',
        'pressure',
        'humidity',
        'speed',
        'deg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
