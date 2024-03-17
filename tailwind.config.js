/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      poppins:["Popins", "sans-serif"]
    },
    extend: {
      colors: {
        'primary-color': '#009b49',
      },
    },
  },
  plugins: [],
}

