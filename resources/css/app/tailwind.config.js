import defaultTheme from 'tailwindcss/defaultTheme';
import colors from "tailwindcss/colors";
import typography from '@tailwindcss/typography';
import brand from '../../js/utils/brand.js'
import { DefaultTheme, DominantTheme, SecondaryTheme, TertiaryTheme, AccentTheme } from '../../js/utils/prose-themes'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                ...brand.fonts,
            },
            colors: {
                info: colors.sky,
                danger: colors.rose,
                success: colors.emerald,
                warning: colors.orange,
                ...brand.colors,
            },
            typography: () => ({
                ...DefaultTheme,
                ...DominantTheme,
                ...SecondaryTheme,
                ...TertiaryTheme,
                ...AccentTheme,
            }),
        },
    },
    plugins: [
        typography
    ],
};
