<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'harga_sewa',
        'deskripsi',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}