const generateColors = (keys) => {
    const colors = {}

    keys.forEach((key) => {
        colors[key] = {
            50: `rgba(var(--${key}-50), <alpha-value>)`,
            100: `rgba(var(--${key}-100), <alpha-value>)`,
            200: `rgba(var(--${key}-200), <alpha-value>)`,
            300: `rgba(var(--${key}-300), <alpha-value>)`,
            400: `rgba(var(--${key}-400), <alpha-value>)`,
            500: `rgba(var(--${key}-500), <alpha-value>)`,
            600: `rgba(var(--${key}-600), <alpha-value>)`,
            700: `rgba(var(--${key}-700), <alpha-value>)`,
            800: `rgba(var(--${key}-800), <alpha-value>)`,
            900: `rgba(var(--${key}-900), <alpha-value>)`,
            950: `rgba(var(--${key}-950), <alpha-value>)`,
        }
    })

    return colors
}

module.exports = {
    generateColors,
}
