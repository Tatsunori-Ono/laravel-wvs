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
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('category');
            $table->string('location');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_items');
    }
};
