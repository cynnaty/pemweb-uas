<?php

// database/migrations/xxxx_xx_xx_create_equipment_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equipment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->integer('harga_sewa');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('equipment_categories');
    }
};