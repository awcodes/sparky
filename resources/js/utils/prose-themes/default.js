const colors = require('tailwindcss/colors')

module.exports = {
    DEFAULT: {
        css: {
            '--tw-prose-body': 'rgb(var(--neutral-900))',
            '--tw-prose-headings': 'rgb(var(--dominant-600))',
            '--tw-prose-lead': 'rgb(var(--neutral-800))',
            '--tw-prose-links': colors.blue[600],
            '--tw-prose-bold': 'rgb(var(--neutral-900))',
            '--tw-prose-counters': 'rgb(var(--neutral-900))',
            '--tw-prose-bullets': 'rgb(var(--neutral-400))',
            '--tw-prose-hr': 'rgb(var(--neutral-300))',
            '--tw-prose-quotes': 'rgb(var(--neutral-900))',
            '--tw-prose-quote-borders': 'rgb(var(--neutral-300))',
            '--tw-prose-captions': 'rgb(var(--neutral-700))',
            '--tw-prose-code': 'rgb(var(--neutral-900))',
            '--tw-prose-pre-code': 'white',
            '--tw-prose-pre-bg': 'rgb(var(--neutral-900))',
            '--tw-prose-th-borders': 'rgb(var(--neutral-400))',
            '--tw-prose-td-borders': 'rgb(var(--neutral-400))',
            '--tw-prose-invert-body': 'rgb(var(--neutral-200))',
            '--tw-prose-invert-headings': 'white',
            '--tw-prose-invert-lead': 'rgb(var(--neutral-100))',
            '--tw-prose-invert-links': colors.blue[400],
            '--tw-prose-invert-bold': 'white',
            '--tw-prose-invert-counters': 'white',
            '--tw-prose-invert-bullets': 'rgb(var(--neutral-600))',
            '--tw-prose-invert-hr': 'rgb(var(--neutral-600))',
            '--tw-prose-invert-quotes': 'white',
            '--tw-prose-invert-quote-borders': 'rgb(var(--neutral-200))',
            '--tw-prose-invert-captions': 'rgb(var(--neutral-300))',
            '--tw-prose-invert-code': 'white',
            '--tw-prose-invert-pre-code': 'white',
            '--tw-prose-invert-pre-bg': 'rgb(var(--neutral-700))',
            '--tw-prose-invert-th-borders': 'rgb(var(--neutral-600))',
            '--tw-prose-invert-td-borders': 'rgb(var(--neutral-600))',
        },
    },
}
