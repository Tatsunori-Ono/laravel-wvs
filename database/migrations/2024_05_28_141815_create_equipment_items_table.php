<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment_items', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_type');
            $table->string('manufacturer')->nullable();
            $table->string('category');
            $table->string('location_stored');
            $table->text('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('quantity');
            $table->integer('rented_quantity')->default(0);
            $table->integer('max_rental_days');
            $table->decimal('price', 8, 2);
            $table->integer('rental_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->timestamps();
        });

        // Create the equipment_images table
        Schema::create('equipment_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_item_id')->constrained('equipment_items')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_images');
        Schema::dropIfExists('equipment_items');
    }
};
