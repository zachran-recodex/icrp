import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#FD38EC',
                    50: '#FFF3FD',
                    100: '#FFE6FE',
                    200: '#FFCCFC',
                    300: '#FFA4F5',
                    400: '#FF6EEF',
                    500: '#FD38EC',
                    600: '#E118CB',
                    700: '#BB10A5',
                    800: '#990F86',
                    900: '#7D126C',
                    950: '#540047',
                },
                background: {
                    light: '#f4f6f7',
                    dark: '#23262b',
                    sidebar: '#171717',
                    footer: '#171717',
                },
            },
        },
    },

    plugins: [forms],
};
