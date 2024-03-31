/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        "comfortaa": ["Comfortaa", "sans-serif"],
        "jakarta-sans": ["Plus Jakarta Sans", "sans-serif"]
      }
    },
  },
  plugins: [],
}

