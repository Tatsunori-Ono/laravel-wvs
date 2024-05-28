// Vite用のファイル

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// resourcesのCSSとJSをコンパイルしてpublicに移す
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/js/navbar.js'
            ],
            refresh: true,
        }),
    ],
});
