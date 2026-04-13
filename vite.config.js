import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/main.css',
                'resources/css/auth/signin.css', 
                'resources/css/auth/signup.css', 
                'resources/css/user/profile.css',
                'resources/css/user/beranda.css',
                'resources/css/user/riwayatposting.css',
                'resources/css/user/tambahposting.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
