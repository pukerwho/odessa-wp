module.exports = {
  mode: 'jit',
  purge: {
    enabled: true,
    content: ["./source/css/tailwind.css", "./**/*.php"],
  },
  darkMode: 'dark-mode', // or 'media' or 'class'
  theme: {
    zIndex: {
      '1': 1,
      '2': 2,
      '10': 10,
    },
    listStyleType: {
      auto: 'auto',
      none: 'none',
      disc: 'disc',
      decimal: 'decimal',
      square: 'square',
    },
    extend: {
      lineHeight: {
        'max': '3',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
