<?php

// プロバイダーの配列を返す
return [
    // アプリケーションサービスプロバイダー
    App\Providers\AppServiceProvider::class,
    // Filament管理パネルプロバイダー
    App\Providers\Filament\AdminPanelProvider::class,
];
