<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// 新しいartisanコマンド "inspire" を定義
Artisan::command('inspire', function () {
    // Laravel の Inspiring クラスから引用文を取得し、コンソールに表示
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();  // コマンドの目的を設定し、毎時実行するようにスケジュール
