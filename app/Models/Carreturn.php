<?php

namespace App\Models;

use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'return_date',
        'fine',
        'car_condition'
    ];

    public function rentals()
    {
        return $this->belongsTo(Rental::class);
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
                'rental_id' => 'required|numeric',
                'return_date' => 'required|date',
                'fine' => 'required|numeric',
                'car_condition' => 'required|string'
            ];
        } elseif ($process == 'update') {
            return [
                'rental_id' => 'required|numeric',
                'return_date' => 'required|date',
                'fine' => 'required|numeric',
                'car_condition' => 'required|string'
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
            'rental_id' => 'ID Rental',
            'return_date' => 'Tanggal Pengembalian',
            'fine' => 'Denda',
            'car_condition' => 'Kondisi Mobil'
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
