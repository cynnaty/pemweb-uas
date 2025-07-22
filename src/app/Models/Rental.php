<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'equipment_category_id',
        'staff_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_harga',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
} 