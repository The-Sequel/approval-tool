import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/customers.js',
                'resources/js/notifications.js',
                'resources/js/filters.js',
                'resources/js/mobile-menu.js',
            ],
            refresh: true,
        }),
    ],
});
