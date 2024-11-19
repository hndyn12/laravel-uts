<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_id',
        'rent_date',
        'return_date',
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

    /**
     * Aturan validasi untuk model ini.
     *
     * @return array
     */
    public static function rules($process)
    {
        if ($process == 'insert') {
            return [
                'car_id' => 'required|numeric',
                'customer_id' => 'required|numeric',
                'rent_date' => 'required|date',
                'return_date' => 'required|date',
                'total_cost' => 'required|numeric',
                'payment_status' => 'required|in:pending,paid'
            ];
        } elseif ($process == 'update') {
            return [
                'car_id' => 'required|numeric',
                'customer_id' => 'required|numeric',
                'rent_date' => 'required|date',
                'return_date' => 'required|date',
                'total_cost' => 'required|numeric',
                'payment_status' => 'required|in:pending,paid'
            ];
        }
    }


    /**
     * Mendaftarkan aturan validasi kustom.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public static function customValidation(Validator $validator)
    {
        $customAttributes = [
            'car_id' => 'ID Mobil',
            'customer_id' => 'ID Pelanggan',
            'rent_date' => 'Tanggal Sewa',
            'return_date' => 'Tanggal Kembali',
            'total_cost' => 'Total Biaya',
            'payment_status' => 'Status Pembayaran'
        ];

        $validator->addReplacer('required', function ($message, $attribute, $rule, $parameters) use ($customAttributes) {
            return str_replace(':attribute', $customAttributes[$attribute], ':attribute harus diisi.');
        });

        $validator->addReplacer('string', function ($message, $attribute, $rule, $parameters) use ($customAttributes) {
            return str_replace(':attribute', $customAttributes[$attribute], ':attribute harus berupa string.');
        });

        $validator->addReplacer('max', function ($message, $attribute, $rule, $parameters) use ($customAttributes) {
            return str_replace(':attribute', $customAttributes[$attribute], ':attribute tidak boleh lebih dari ' . $parameters[0] . ' karakter.');
        });

        $validator->addReplacer('date', function ($message, $attribute, $rule, $parameters) use ($customAttributes) {
            return str_replace(':attribute', $customAttributes[$attribute], ':attribute harus berupa tanggal yang valid.');
        });

        $validator->addReplacer('numeric', function ($message, $attribute, $rule, $parameters) use ($customAttributes) {
            return str_replace(':attribute', $customAttributes[$attribute], ':attribute harus berupa angka.');
        });
    }
}
