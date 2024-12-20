<?php

namespace App\Models;

use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'license_plate',
        'rate',
        'availability'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
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
                'brand' => 'required|string|max:225',
                'model' => 'required|string|max:225',
                'license_plate' => 'required|string|max:225',
                'rate' => 'required|numeric',
            ];
        } elseif ($process == 'update') {
            return [
                'brand' => 'required|string|max:225',
                'model' => 'required|string|max:225',
                'license_plate' => 'required|string|max:225',
                'rate' => 'required|numeric',
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
            'brand' => 'Brand Mobil',
            'model' => 'Model Mobil',
            'license_plate' => 'Plat Mobil',
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
    }
}
