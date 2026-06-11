/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#4A3A2A',
        secondary: '#30251A',
        accent: '#e2ddca',
        grey: '#555555',
        background: '#FCFCFC',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        serif: ['"Crimson Pro"', 'serif'],
      }
    },
  },
  plugins: [],
}
