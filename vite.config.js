import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Defaugglt app.css
                'resources/css/style.css', // Add your custom style.css
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
