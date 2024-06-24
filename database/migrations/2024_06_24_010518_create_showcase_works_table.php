<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcaseWorksTable extends Migration
{
    public function up()
    {
        Schema::create('showcase_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('showcase_item_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showcase_works');
    }
}
