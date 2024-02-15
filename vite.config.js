import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: 'resources/js/app.jsx',
            refresh: true,
        }),
        
    ],
    // resolve: {
    //     alias: {
    //         'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
    //         // 'vendor/tightenco/ziggy/dist/vue.es.js' if using the Vue plugin
    //     },
    // },
});
