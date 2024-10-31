const plugin = require('tailwindcss/plugin')

const generateBarGradient = (key) => {
    let shade = key === 'neutral' ? 300 : 600
    let bgShade = key === 'neutral' ? 100 : 400

    return `linear-gradient(
        132deg,
        rgba(var(--${key}-${shade}), 1) 0%,
        rgba(var(--${key}-${shade}), 1) 10%,
        rgba(var(--${key}-${shade}), .9) 10%,
        rgba(var(--${key}-${shade}), .95) 14%,
        rgba(var(--${key}-${shade}), .8) 14%,
        rgba(var(--${key}-${shade}), .85) 20%,
        rgba(var(--${key}-${shade}), .7) 20%,
        rgba(var(--${key}-${shade}), .6) 30%,
        rgba(var(--${key}-${shade}), .6) 46%,
        rgba(var(--${key}-${shade}), .9) 46%,
        rgba(var(--${key}-${shade}), .9) 61%,
        rgba(var(--${key}-${shade}), .9) 63%,
        rgba(var(--${key}-${shade}), .95) 70%,
        rgba(var(--${key}-${shade}), .7) 70%,
        rgba(var(--${key}-${shade}), .8) 79%,
        rgba(var(--${key}-${shade}), .9) 79%,
        rgba(var(--${key}-${shade}), .9) 88%,
        rgba(var(--${key}-${shade}), .9) 100%
    ), linear-gradient(to right, rgba(var(--${key}-${bgShade}), 1), rgba(var(--${key}-${bgShade}), 1))`
}

const generateRadialGradient = (key, insideShade = 500, outsideShade = 800) => {
    return `radial-gradient(rgba(var(--${key}-${insideShade}), 1), rgba(var(--${key}-${outsideShade}), 1))`
}

const BarGradientPlugin = plugin(function ({ matchUtilities, theme }) {
    matchUtilities(
        {
            'bg-gradient-bars': (value) => ({
                background: generateBarGradient(value),
            }),
        },
        {
            values: theme('gradientColors'),
        },
    )
})

const RadialGradientPlugin = plugin.withOptions(function (options = {}) {
    return function ({ matchUtilities, theme }) {
        matchUtilities(
            {
                'bg-gradient-radial': (value) => ({
                    background: generateRadialGradient(
                        value,
                        options?.insideShade,
                        options?.outsideShade,
                    ),
                }),
            },
            {
                values: theme('gradientColors'),
            },
        )
    }
})

module.exports = {
    BarGradientPlugin,
    RadialGradientPlugin,
}
