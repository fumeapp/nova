import { defineConfig } from 'windicss/helpers'

export const colors = {
  swatch1: '#050212',
  swatch2: '#09154a',
  swatch3: '#009ee9',
  swatch4: '#005ed6',
  swatch5: '#00d8f9',
  swatch6: '#0044ba',
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
})
