<?php

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder {
    public function run(): void {
        Staff::insert([
            ['nama' => 'Rudi Hartono', 'email' => 'rudi@campease.com', 'posisi' => 'Admin'],
            ['nama' => 'Lisa Marlina', 'email' => 'lisa@campease.com', 'posisi' => 'Petugas Gudang'],
        ]);
    }
}