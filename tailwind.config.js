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
                    DEFAULT: '#bf15a5',
                    '50': '#fff3fe',
                    '100': '#ffe7fd',
                    '200': '#ffcefb',
                    '300': '#ffa7f6',
                    '400': '#ff72ef',
                    '500': '#f83de3',
                    '600': '#dc1dc3',
                    '700': '#bf15a5',
                    '800': '#951380',
                    '900': '#7a1568',
                    '950': '#520042',
                },
                secondary: {
                    DEFAULT: '#ae848b',
                    '50': '#faf6f7',
                    '100': '#f5eeef',
                    '200': '#ebe0e1',
                    '300': '#dbc6c9',
                    '400': '#c6a6ab',
                    '500': '#ae848b',
                    '600': '#966872',
                    '700': '#7c545e',
                    '800': '#694851',
                    '900': '#5b4048',
                    '950': '#312025',
                },
                tertiary: {
                    DEFAULT: '#a41679',
                    '50': '#fff4fd',
                    '100': '#ffe7fb',
                    '200': '#ffcff5',
                    '300': '#fea9e9',
                    '400': '#fc76d9',
                    '500': '#f441c6',
                    '600': '#d821a4',
                    '700': '#a41679',
                    '800': '#92166a',
                    '900': '#771857',
                    '950': '#500235',
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
