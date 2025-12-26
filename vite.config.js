import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',    // SCSS з Bootstrap
                'resources/css/app.css',      // Додатковий CSS
                'resources/js/bootstrap.js',  // Bootstrap JS
                'resources/js/app.js',        // Основний JS
                'resources/css/main/style.css',
                'resources/js/main_style/scripts.js'
            ],
            refresh: true,
        }),
    ],
});
