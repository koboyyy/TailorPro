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
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
        surface: 'var(--color-surface)',
        grey: 'var(--color-grey)',
        background: 'var(--color-background)',
        'on-surface': 'var(--color-on-surface)',
      },
      fontFamily: {
        sans: ['"DM Sans"', 'sans-serif'],
        serif: ['"DM Sans"', 'sans-serif'],
      }
    },
    plugins: [],
  }
}
