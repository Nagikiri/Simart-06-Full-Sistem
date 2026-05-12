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
                manrope: ['Manrope', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                civic: {
                    primary:           '#00685d',
                    'primary-container':'#008376',
                    'on-primary':      '#ffffff',
                    secondary:         '#2b6485',
                    'secondary-container': '#a3d8fe',
                    tertiary:          '#416538',
                    'tertiary-container': '#597e4f',
                    'tertiary-fixed':  '#c5eeb5',
                    surface:           '#f7f9fb',
                    'surface-low':     '#f2f4f6',
                    'surface-container': '#eceef0',
                    'surface-high':    '#e6e8ea',
                    'surface-highest': '#e0e3e5',
                    'surface-lowest':  '#ffffff',
                    'on-surface':      '#191c1e',
                    'on-surface-variant': '#3d4947',
                    outline:           '#6d7a77',
                    'outline-variant': '#bcc9c6',
                    error:             '#ba1a1a',
                    'error-container': '#ffdad6',
                    'inverse-primary': '#6fd8c8',
                    'inverse-surface': '#2d3133',
                },
                brand: {
                    teal:    '#2A9D8F',
                    blue:    '#457B9D',
                    green:   '#8AB17D',
                    neutral: '#F8FAFC',
                },
            },
            borderRadius: {
                'civic':   '0.5rem',
                'civic-md':'0.75rem',
                'civic-lg':'1rem',
                'civic-xl':'1.5rem',
            },
            boxShadow: {
                'ambient': '0px 12px 32px rgba(25, 28, 30, 0.06)',
                'soft':    '0px 4px 16px rgba(25, 28, 30, 0.04)',
            },
        },
    },

    plugins: [forms],
};
