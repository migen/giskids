/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{html,php}", "./views/**/*.php"],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#faf8f1',
          100: '#f5f1e3',
          200: '#ebe3c7',
          300: '#e0d4aa',
          400: '#d6c68e',
          500: '#C5A253', // Main antique gold
          600: '#b1924b',
          700: '#9d8242',
          800: '#8a723a',
          900: '#766231',
        },
        secondary: {
          50: '#eef2ff',
          100: '#e0e7ff',
          200: '#c7d2fe',
          300: '#a5b4fc',
          400: '#818cf8',
          500: '#6366f1',
          600: '#2C3E86', // Main royal blue
          700: '#253470',
          800: '#1e2a5a',
          900: '#172044',
        }
      }
    },
  },
  plugins: [],
}