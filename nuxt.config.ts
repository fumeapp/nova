const meta = {
  title: 'Nova',
  description: 'Description for Nova.',
  url: process.env.WEB_URL,
  image: process.env.WEB_URL + '/nova.png',
}

import { colors } from "./windi.config"

export default defineNuxtConfig({
  srcDir: 'client/',
  app: {
    head: {
      title: meta.title,
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: meta.description },
        { name: 'msapplication-TileColor', content: colors.swatch5 },
        { name: 'theme-color', content: colors.swatch5 },

        // Schema.org
        { hid: 'itemprop:name', content: meta.title },
        { hid: 'itemprop:description', content: meta.description },
        { hid: 'itemprop:image', content: meta.image },

        // facebook
        { hid: 'og:type', property: 'og:type', content: 'website' },
        { hid: 'og:site_name', property: 'og:site_name', content: meta.title },
        { hid: 'og:url', property: 'og:url', content: meta.url },
        { hid: 'og:image', property: 'og:image', content: meta.image },
        { hid: 'og:title', property: 'og:title', content: meta.title },
        { hid: 'og:description', property: 'og:description', content: meta.description },

        // twitter
        { hid: 'twitter:card', name: 'twitter:card', content: 'summary_large_image' },
        { hid: 'twitter:image', name: 'twitter:image', content: meta.image },
        { hid: 'twitter:title', name: 'twitter:title', content: meta.title },
        { hid: 'twitter:description', name: 'twitter:description', content: meta.description },

        // mobile
        { name: 'apple-mobile-web-app-capable', content: 'yes' },
        { name: 'mobile-web-app-capable', content: 'yes' },
        { name: 'apple-mobile-mobile-web-app-status-bar-style', content: colors.swatch5 },

        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: meta.description },
      ],
      link: [
        { rel: 'icon', id: 'favicon', type: 'image/x-icon', href: '/favicon.ico' },
        { rel: 'apple-touch-icon', sizes: '180x180', href: '/apple-touch-icon.png' },
        { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon-32x32.png' },
        { rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicon-16x16.png' },
        { rel: 'manifest', href: '/site.webmanifest' },
        { rel: 'mask-icon', href: '/safari-pinned-tab.svg', color: colors.swatch5 },
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: 'anonymous' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap', media: 'screen' },
      ],
      script: [
        { src: '//cdnjs.cloudflare.com/ajax/libs/lottie-web/5.8.1/lottie.min.js' },
        { src: '//cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js', async: true },
        { src: '//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js', async: true },
        { src: '//cdn.jsdelivr.net/npm/maska@1.5.1/dist/maska.js', async: true },
      ],
    },
  },
  css: [
    '@/assets/css/main.css',
    '@/assets/css/device.css',
  ],

  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: [
    '~/components',
    '~/components/item',
    '~/components/form',
    '~/components/header',
    '~/components/layout',
    '~/components/transition',
  ],

  /**
   * @see https://v3.nuxtjs.org/api/configuration/nuxt.config#modules
   */
  modules: [
    '@vueuse/nuxt',
    'nuxt-windicss',
    '@tailvue/nuxt',
  ],

  /**
   * @see https://v3.nuxtjs.org/guide/features/runtime-config#exposing-runtime-config
   */
  runtimeConfig: {
    public: {
      webURL: process.env.WEB_URL || 'http://localhost:3000',
      apiURL: process.env.API_URL || 'http://localhost:8000',
    },
  },

  /**
   * WindiCSS configuration
   * @see https://github.com/windicss/nuxt-windicss
   */
  windicss: {
    analyze: false,
  },

})
