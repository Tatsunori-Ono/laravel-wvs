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
        // contact_forms テーブルに user_id カラムを追加し、外部キー制約を設定
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Adding user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Setting up foreign key relationship
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
