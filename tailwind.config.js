/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./public/*.php",
      "./templates/**/*.twig",
      "./public/**/*.{php}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require("@tailwindcss/typography"),
      require("@tailwindcss/forms"),
      require('daisyui')],

    daisyui: {
      themes: ['light']
    }
}

