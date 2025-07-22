<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('equipment_category_id')->constrained('equipment_categories')->onDelete('cascade');
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('set null')->nullable();
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rentals');
    }
};