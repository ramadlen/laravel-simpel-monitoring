<?php
namespace App\Casts;

use App\Models\StatusEnum; // pastikan StatusEnum sudah ada
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class StatusEnumCast implements CastsAttributes
{
    /**
     * Mengubah nilai kolom yang diambil dari database
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        // Mengonversi nilai dari database ke enum
        return StatusEnum::from($value); // pastikan StatusEnum adalah enum yang valid
    }

    /**
     * Menyimpan nilai ke database sebelum disimpan
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        // Mengonversi enum ke nilai yang disimpan di database (misalnya string)
        return $value instanceof StatusEnum ? $value->value : $value;
    }
}
