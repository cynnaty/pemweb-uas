<?php

// database/seeders/CustomerSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder {
    public function run(): void {
        Customer::insert([
            ['nama' => 'Andi Pratama', 'email' => 'andi@gmail.com', 'nomor_hp' => '081234567890'],
            ['nama' => 'Siti Aminah', 'email' => 'siti@gmail.com', 'nomor_hp' => '081298765432'],
        ]);
    }
}