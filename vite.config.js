import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/site.css',
                'resources/css/cp.css',
                'resources/js/site.js',
                'resources/js/cp.js',
            ],
            refresh: true,
        }),
    ]
});
