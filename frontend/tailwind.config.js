module.exports = {
  purge: {
    content: [
      './index.html',
      './src/**/*.vue'
    ],
    options: {
      safelist: {
        standard: [/tier$/]
      }
    }
  },
  theme: {
    screens: {
      xs: '528px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px'
    },
    extend: {
      colors: {
        's-tier': 'var(--s-tier)',
        'a-tier': 'var(--a-tier)',
        'b-tier': 'var(--b-tier)',
        'c-tier': 'var(--c-tier)',
        'u-tier': 'var(--u-tier)',

        'border-grey': 'var(--border-grey)',
        'border-black': 'var(--border-black)',

        'bright-1': 'var(--bright-1)',
        'dark-1': 'var(--dark-1)',
        'dark-2': 'var(--dark-2)',
        'dark-3': 'var(--dark-3)',
        'dark-4': 'var(--dark-4)',
        'dark-5': 'var(--dark-5)',

        'primary': 'var(--primary)'
      },
      spacing: {
        '1.5': '0.3rem',
        '14': '3.4rem',
        '80': '20rem',
        '112': '28rem',
        '120': '30rem'
      },
      minWidth: theme => theme('spacing'),
      minHeight: theme => theme('spacing'),
      borderRadius: {
        'xl': '0.8rem'
      }
    }
  },
  variants: {},
  plugins: []
}
