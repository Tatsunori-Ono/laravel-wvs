<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        // users テーブルに google2fa_secret と is_enable_google2fa カラムを追加
        Schema::table('users', function (Blueprint $table) {
            $table->string('google2fa_secret')->nullable()->after('remember_token');
            $table->boolean('is_enable_google2fa')->default(false)->after('google2fa_secret');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google2fa_secret', 'is_enable_google2fa']);
        });
    }
};
