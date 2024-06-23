import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/loader.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
    esbuild: {
        loader: 'jsx',
        include: /src\/.*\.js$/,
    },
});
