<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';

    protected $fillable = [
        'brand',       
        'model',       
        'plate_number',
        'rental_rate_per_day',
        'is_available',
        'user_id'
    ];

    protected $attributes = [
        'is_available' => true, 
    ];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('brand', 'like', "%{$keyword}%")
                     ->orWhere('model', 'like', "%{$keyword}%");
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
