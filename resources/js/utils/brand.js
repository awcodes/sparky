import defaultTheme from 'tailwindcss/defaultTheme';
import { generateColors } from './color-builder.js'

module.exports = {
    colors: {
        custom: {
            50: 'rgba(var(--c-50), <alpha-value>)',
            100: 'rgba(var(--c-100), <alpha-value>)',
            200: 'rgba(var(--c-200), <alpha-value>)',
            300: 'rgba(var(--c-300), <alpha-value>)',
            400: 'rgba(var(--c-400), <alpha-value>)',
            500: 'rgba(var(--c-500), <alpha-value>)',
            600: 'rgba(var(--c-600), <alpha-value>)',
            700: 'rgba(var(--c-700), <alpha-value>)',
            800: 'rgba(var(--c-800), <alpha-value>)',
            900: 'rgba(var(--c-900), <alpha-value>)',
            950: 'rgba(var(--c-950), <alpha-value>)',
        },
        ...generateColors([
            'dominant',
            'secondary',
            'tertiary',
            'accent',
            'neutral',
        ]),
    },
    fonts: {
        display: ['Open Sans', ...defaultTheme.fontFamily.sans],
        body: ['Open Sans', ...defaultTheme.fontFamily.sans],
        legal: ['Tahoma', ...defaultTheme.fontFamily.sans]
    },
}
