<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'return_date',
        'total_unit_kembali',
        'fine',
        'car_condition'
    ];

    public function rentals()
    {
        return $this->belongsTo(Rental::class);
    }
}
