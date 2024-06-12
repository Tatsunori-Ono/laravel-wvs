import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
    esbuild: {
        loader: 'jsx',  // Add this line to enable JSX syntax
        include: /src\/.*\.js$/,  // Apply this loader only to JS files in the src folder
    },
});
