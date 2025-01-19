<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCar extends Model
{
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = [
        'rental_id',
        'returned_at',
        'days_used',
        'total_cost',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
