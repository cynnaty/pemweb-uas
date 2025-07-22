<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'posisi',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}