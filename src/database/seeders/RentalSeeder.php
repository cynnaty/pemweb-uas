<?php

use Illuminate\Database\Seeder;
use App\Models\Rental;

class RentalSeeder extends Seeder {
    public function run(): void {
        Rental::insert([
            [
                'customer_id' => 1,
                'equipment_category_id' => 1,
                'staff_id' => 1,
                'tanggal_sewa' => '2025-07-20',
                'tanggal_kembali' => '2025-07-22',
                'total_harga' => 150000
            ],
            [
                'customer_id' => 2,
                'equipment_category_id' => 2,
                'staff_id' => 2,
                'tanggal_sewa' => '2025-07-21',
                'tanggal_kembali' => '2025-07-23',
                'total_harga' => 30000
            ],
        ]);
    }
}