import preset from '../../../../vendor/filament/filament/tailwind.config.preset'
import brand from '../../../js/utils/brand.js'
import { generateColors } from '../../../js/utils/color-builder.js'
import { DefaultTheme, DominantTheme, SecondaryTheme, TertiaryTheme, AccentTheme } from '../../../js/utils/prose-themes'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/components/blocks/**/*.blade.php',
        './resources/views/components/{prose,section,card}.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',
        './vendor/saade/filament-adjacency-list/resources/views/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/awcodes/palette/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                ...generateColors([
                    'dominant',
                    'secondary',
                    'tertiary',
                    'accent',
                    'neutral',
                ]),
            },
            fontFamily: {
                ...brand.fonts,
            },
            typography: () => ({
                ...DefaultTheme,
                ...DominantTheme,
                ...SecondaryTheme,
                ...TertiaryTheme,
                ...AccentTheme,
            }),
            borderRadius: {
                sm: '0.125rem',
                DEFAULT: '0.25rem',
                md: '0.25rem',
                lg: '0.375rem',
                xl: '0.5rem',
                '2xl': '1rem',
                '3xl': '1.5rem',
            },
        }
    }
}
