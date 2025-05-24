import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server:{
        host: true,
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/message.js',
                'resources/js/pusher.js',
                'resources/js/signature-pad.js'
            ],
            refresh: true,
        }),
    ],
});
