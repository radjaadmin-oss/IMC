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
                // Primary Brand Colors
                'primary': {
                    50: '#FEF2F2',
                    100: '#FEE2E2',
                    200: '#FECACA',
                    300: '#FCA5A5',
                    400: '#F87171',
                    500: '#EF4444',
                    600: '#DC2626',  // Main primary
                    700: '#B91C1C',  // Hover
                    800: '#991B1B',
                    900: '#7F1D1D',
                },
                // Dark Theme
                'dark': {
                    bg: '#0A0A0A',
                    card: '#141414',
                    hover: '#1A1A1A',
                    sidebar: '#080808',
                    topbar: '#0F0F0F',
                },
                // Legacy colors (keep for compatibility)
                'navy-dark': '#050B14',
                'navy-card': '#0B1220',
                'navy-footer': '#081018',
                'gold': '#F5C518',
                'gold-dark': '#D4A017',
            },
            borderRadius: {
                'xl': '1.25rem',   // 20px
                '2xl': '1.5rem',   // 24px
                '3xl': '1.75rem',  // 28px
            },
            // Animations
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-100%)' },
                },
                shimmer: {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(100%)' },
                },
                slideIn: {
                    '0%': { transform: 'translateY(-100%)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
            },
            animation: {
                marquee: 'marquee 10s linear infinite',
                shimmer: 'shimmer 2s infinite',
                slideIn: 'slideIn 0.3s ease-out',
                fadeIn: 'fadeIn 0.3s ease-out',
            },
        },
    },

    plugins: [forms],
};
