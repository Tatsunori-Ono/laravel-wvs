// Vite用のファイル

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

// resourcesのCSSとJSをコンパイルしてpublicに移す
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/js/navbar.js',
                'resources/sass/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        react(),
    ],
});
