import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Bootstrap + SCSS
                'resources/css/app.css',    // Додатковий CSS
                'resources/js/app.js',      // JS
            ],
            refresh: true,
        }),
    ],
});
