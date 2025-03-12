import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
    screen: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px",
    },
    container: {
      center: true,
      padding: "1rem",
    },
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        roboto: ["Roboto", "sans-serif"],
      },
      colors: {
        primary: "#3F51B5",
        secondary:"#FF9800",
        tertiary:"#EAEAEA",
        ternary:"#F0F1F1",
        whiten: '#F1F5F9',
        whiter: '#F5F7FD',
        boxdark: '#24303F',
        'boxdark-2': '#1A222C',
        strokedark: '#2E3A47',
        'form-strokedark': '#3d4d60',
        'form-input': '#1d2a39',
        'meta-1': '#DC3545',
        'meta-2': '#EFF2F7',
        'meta-3': '#10B981',
        'meta-4': '#313D4A',
        'meta-5': '#259AE6',
        'meta-6': '#FFBA00',
        'meta-7': '#FF6766',
        'meta-8': '#F0950C',
        'meta-9': '#E5E7EB',
        'meta-10': '#0FADCF',
        success: '#219653',
        danger: '#D34053',
        warning: '#FFA70B'
      },
       zIndex: {
                999999: '999999',
                99999: '99999',
                9999: '9999',
                999: '999',
                99: '99',
                9: '9',
                1: '1'
            },
            keyframes: {
                linspin: {
                    '100%': { transform: 'rotate(360deg)' }
                },
                easespin: {
                    '12.5%': { transform: 'rotate(135deg)' },
                    '25%': { transform: 'rotate(270deg)' },
                    '37.5%': { transform: 'rotate(405deg)' },
                    '50%': { transform: 'rotate(540deg)' },
                    '62.5%': { transform: 'rotate(675deg)' },
                    '75%': { transform: 'rotate(810deg)' },
                    '87.5%': { transform: 'rotate(945deg)' },
                    '100%': { transform: 'rotate(1080deg)' }
                },
                'left-spin': {
                    '0%': { transform: 'rotate(130deg)' },
                    '50%': { transform: 'rotate(-5deg)' },
                    '100%': { transform: 'rotate(130deg)' }
                },
                'right-spin': {
                    '0%': { transform: 'rotate(-130deg)' },
                    '50%': { transform: 'rotate(5deg)' },
                    '100%': { transform: 'rotate(-130deg)' }
                },
                rotating: {
                    '0%, 100%': { transform: 'rotate(360deg)' },
                    '50%': { transform: 'rotate(0deg)' }
                },
                topbottom: {
                    '0%, 100%': { transform: 'translate3d(0, -100%, 0)' },
                    '50%': { transform: 'translate3d(0, 0, 0)' }
                },
                bottomtop: {
                    '0%, 100%': { transform: 'translate3d(0, 0, 0)' },
                    '50%': { transform: 'translate3d(0, -100%, 0)' }
                }
            },
            animation: {
                linspin: 'linspin 1568.2353ms linear infinite',
                easespin: 'easespin 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both',
                'left-spin': 'left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both',
                'right-spin': 'right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both',
                'ping-once': 'ping 5s cubic-bezier(0, 0, 0.2, 1)',
                rotating: 'rotating 30s linear infinite',
                topbottom: 'topbottom 60s infinite alternate linear',
                bottomtop: 'bottomtop 60s infinite alternate linear',
                'spin-1.5': 'spin 1.5s linear infinite',
                'spin-2': 'spin 2s linear infinite',
                'spin-3': 'spin 3s linear infinite'
            }
    },
  },

    plugins: [forms, typography],
};
