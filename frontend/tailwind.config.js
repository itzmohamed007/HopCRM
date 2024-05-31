/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false,
  theme: {
    extend: {
      colors: {
        customCyan: 'rgb(25,190,202)',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
