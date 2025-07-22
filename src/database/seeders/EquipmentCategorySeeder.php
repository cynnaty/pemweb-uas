<?php

// database/seeders/EquipmentCategorySeeder.php

use Illuminate\Database\Seeder;
use App\Models\EquipmentCategory;

class EquipmentCategorySeeder extends Seeder {
    public function run(): void {
        EquipmentCategory::insert([
            ['nama_alat' => 'Tenda 4 Orang', 'harga_sewa' => 75000, 'deskripsi' => 'Tenda kapasitas 4 orang.'],
            ['nama_alat' => 'Matras Gulung', 'harga_sewa' => 15000, 'deskripsi' => 'Matras gulung tahan air.'],
            ['nama_alat' => 'Kompor Portable', 'harga_sewa' => 20000, 'deskripsi' => 'Kompor gas mini outdoor.'],
        ]);
    }
}