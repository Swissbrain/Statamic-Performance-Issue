import typography from '@tailwindcss/typography'
import calculateWidthGaps from './resources/js/widthGapCalculation'
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: null,
    content: [
        './resources/**/*.antlers.html',
        './resources/**/*.antlers.php',
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        './content/**/*.md',
        './vendor/livewire/flux-pro/stubs/**/*.blade.php',
        './vendor/livewire/flux/stubs/**/*.blade.php',
    ],

    theme: {
        extend: {
            keyframes: {
                'zoom': {
                    '0%': { 'background-size': '120%' },
                    '100%': { 'background-size': '100%' },
                },
            },
            animation: {
                zoom: 'zoom 10s ease-in',
            },
            fontFamily: {
                'sans': ['Jost']
            },
            width: calculateWidthGaps(),
            maxWidth: () => calculateWidthGaps(),
            minWidth: () => calculateWidthGaps(),
            colors: {
                accent: {
                    DEFAULT: '#2543a8',
                    content: '#21387c',
                    foreground: '#FFCC1A'
                },

                primary: {
                    DEFAULT: '#21387c',
                    '50': '#f0f6fe',
                    '100': '#ddeafc',
                    '200': '#c2dbfb',
                    '300': '#98c4f8',
                    '400': '#68a5f2',
                    '500': '#4483ed',
                    '600': '#2f66e1',
                    '700': '#2651cf',
                    '800': '#2543a8',
                    '900': '#21387c',
                    '950': '#1a2751',
                },
                secondary: {
                    DEFAULT: '#FFCC1A',
                    '50': '#fefce8',
                    '100': '#fff9c2',
                    '200': '#ffef87',
                    '300': '#ffdf43',
                    '400': '#ffcc1a',
                    '500': '#efb103',
                    '600': '#ce8800',
                    '700': '#a46004',
                    '800': '#884a0b',
                    '900': '#733d10',
                    '950': '#431f05',
                },

            }
        }
    },

    plugins: [
        typography
    ],
};