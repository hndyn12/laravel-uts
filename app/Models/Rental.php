<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_id',
        'rent_date',
        'return_date',
        'total_unit_rental',
        'total_cost',
        'payment_status'
    ];

    public function cars()
    {
        return $this->belongsTo(Car::class);
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
    public function carreturns()
    {
        return $this->hasOne(Carreturn::class);
    }
}
