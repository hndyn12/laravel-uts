<?php

namespace App\Models;

use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
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
                'name' => 'required|string|max:225',
                'phone' => 'required|string|max:225',
                'address' => 'required|string|max:225',
            ];
        } elseif ($process == 'update') {
            return [
                'name' => 'required|string|max:225',
                'phone' => 'required|string|max:225',
                'address' => 'required|string|max:225',
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
            'name' => 'Nama',
            'phone' => 'NomorTelepon',
            'address' => 'Alamat'
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
