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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'navy-dark': '#050B14',
                'navy-card': '#0B1220',
                'navy-footer': '#081018',
                'gold': '#F5C518',
                'gold-dark': '#D4A017',
            },
            // · ADDED: Marquee Animation for Event Organizer Name
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-100%)' },
                }
            },
            animation: {
                marquee: 'marquee 10s linear infinite',
            }
        },
    },

    plugins: [forms],
};
