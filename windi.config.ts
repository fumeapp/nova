import { defineConfig } from 'windicss/helpers'
import windicssColors from 'windicss/colors'

export const colors = {
  swatch1: '#374989',
  swatch2: '#211440',
  swatch3: '#009ee9',
  swatch4: '#005ed6',
  swatch5: '#00d8f9',
  swatch6: '#0044ba',
  gray: windicssColors.zinc,
}

export default defineConfig({
  darkMode: 'class',
  extract: {
    include: [
      "./client/**/*.{vue,ts}",
      "node_modules/tailvue/dist/tailvue.es.js",
      "node_modules/tailvue/dist/tailvue.umd.js",
    ],
  },
  theme: {
    extend: {
      colors,
    },
  },
  plugins: [
    require('windicss/plugin/forms'),
  ],
})
