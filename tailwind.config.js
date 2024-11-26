/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,php}", "./**/*.{html,php}"],
  theme: {
    extend: {
      fontFamily: {
        roboto: ["Roboto", "sans-serif"],
      },
    },
  },
  plugins: [],
};
