const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                surface: {
                    DEFAULT: '#fafafa',
                    raised: '#ffffff',
                    muted: '#f4f4f5',
                },
            },
            boxShadow: {
                premium:
                    '0 1px 2px 0 rgb(0 0 0 / 0.04), 0 4px 12px -2px rgb(0 0 0 / 0.06)',
                'premium-lg':
                    '0 2px 4px 0 rgb(0 0 0 / 0.04), 0 12px 24px -4px rgb(0 0 0 / 0.08)',
            },
            borderRadius: {
                '4xl': '2rem',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
