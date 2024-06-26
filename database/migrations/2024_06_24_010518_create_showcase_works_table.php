<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseWorksTable extends Migration
{
    public function up()
    {
        // showcase_works テーブルを作成
        Schema::create('showcase_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('showcase_item_id')->constrained()->onDelete('cascade'); // showcase_item_id カラム、showcase_items テーブルへの外部キー参照、関連するショーケースアイテム削除時にこのレコードも削除
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showcase_works');
    }
}
