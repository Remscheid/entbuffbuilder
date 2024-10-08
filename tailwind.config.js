/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'swgDarkBlue': '#004B56',
        'swgBlue': '#35BDCE',
        'swgLightBlue': '#00E3F3',
        'swgLighterBlue': '#9CF0FA',
        'swgOrange': '#FBA22E',
        'swgDarkOrange': '#D87C04',
      },
      boxShadow: {
        'swg': '0 0 0 .2rem rgba(53,189,206,.25)',
      },
      transitionProperty: {
        'topleft': 'top, left',
      }
    },
  },
  plugins: [],
}
