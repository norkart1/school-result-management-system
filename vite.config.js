import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '0.0.0.0'
        },
        allowedHosts: 'all'
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Default app.css
                'resources/css/style.css', // Add your custom style.css
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
