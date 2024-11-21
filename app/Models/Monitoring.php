<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    
    protected $fillable = [
        'nama',
        'unit',
        'no_rm_yangdibatalkan',
        'perihal_pembatalan',
    ];
    /**
     * Casting kolom 'status' ke enum
     */
    protected $casts = [
        'unit' => StatusEnum::class,
    ];

    /**
     * Mendapatkan status dalam bentuk enum
     *
     * @return StatusEnum
     */
    public function getStatusEnum(): StatusEnum
    {
        return StatusEnum::from($this->unit);
    }
}
