import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
        'node_modules/flowbite-react/lib/esm/**/*.js',
    ],

    theme: {
        extend: {
            colors:{
                "primary":"#010851",
                 "secondary":"#9A7AF1",
                 "tartiary":"#707070",
                 "pink":"#EE9AE5"
              },
            boxShadow: {
                '3xl': ' 0px 25px 20px -20px rgba(0, 0, 0, 0.45) ;',
              }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        require('@tailwindcss/forms')
    
    ],
};
