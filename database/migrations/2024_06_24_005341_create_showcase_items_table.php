<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseItemsTable extends Migration
{
    public function up()
    {
        // showcase_items テーブルを作成
        Schema::create('showcase_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user_id カラム、users テーブルへの外部キー参照、ユーザー削除時に関連するショーケース項目も削除
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showcase_items');
    }
}
