const plugin = require('tailwindcss/plugin')

const TextShadowPlugin = plugin(
    function ({ matchUtilities, theme }) {
        matchUtilities(
            {
                'text-shadow': (value) => ({
                    textShadow: value,
                }),
            },
            { values: theme('textShadow') },
        )
    },
    {
        theme: {
            textShadow: {
                none: 'none',
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },
        },
    },
)

module.exports = {
    TextShadowPlugin,
}
