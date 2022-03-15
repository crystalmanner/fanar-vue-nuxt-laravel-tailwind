import pkg from "./package";

const webpack = require("webpack");

import en from "./locales/en.json";
import ar from "./locales/ar.json";

export const languages = {
  en: en,
  ar: ar
};
const messages = Object.assign(languages);
const defaultLang = "ar";

export default {
  mode: "universal",
  // router: {
  //   middleware: "detectRoute"
  // },
  serverMiddleware: ["~/serverMiddleware/seo.js"],
  /*
   ** Headers of the page
   */
  head: {
    title: pkg.name,
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" }
    ],
    link: [
      { rel: "icon", type: "image/x-icon", href: "/favicon.png" },
      {
        rel: "stylesheet",
        href: "https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      },
      { rel: "stylesheet", type: "text/css", href: "/css/modal-video.min.css" },
      { rel: "stylesheet", type: "text/css", href: "/css/venobox.css" }
    ],
    script: [
      // {
      //   src: "/js/jquery-3.3.1.min.js", body: true
      // },
      // {
      //   src: "/js/main.js", body: true
      // },
      // {
      //   src: "/js/plugins/jquery-modal-video.min.js", body: true
      // },
    ]
  },

  /*
   ** Customize the progress-bar color
   */
  loading: { color: "#3489D8", height: "5px" },

  /*
   ** Global CSS
   */
  css: [
    "~/assets/css/tailwind.css",
    "~/assets/scss/styles.scss",
    "~/static/js/plugins/slick/slick.css",
    "~/static/js/plugins/fotorama/fotorama.css",
    "swiper/dist/css/swiper.css"
  ],

  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    "~/plugins/VueSelect",
    "~/plugins/countryCode",
    { src: "~/plugins/InstantSearch", ssr: false },
    { src: "~/plugins/vue-swiper", ssr: false },
    { src: "~/plugins/vue2-google-maps" },
    { src: "~/static/js/plugins/jquery-modal-video.min.js", ssr: false },
    { src: "~/static/js/plugins/slick/slick.min.js", ssr: false },
    { src: "~/static/js/plugins/venobox.min.js", ssr: false },
    { src: "~/static/js/plugins/fotorama/fotorama.js", ssr: false },
    { src: "~/static/js/main.js", ssr: false }
  ],
  styleResources: {
    scss: ["./assets/scss/base/_mixins.scss", "./assets/scss/base/_utils.scss"]
  },
  /*
   ** Nuxt.js modules
   */
  modules: [
    "@nuxtjs/style-resources",
    [
      "nuxt-i18n",
      {
        locales: [
          {
            code: "ar",
            name: "Arabic",
            iso: "ar"
          },
          {
            code: "en",
            name: "English",
            iso: "en"
          }
        ],
        defaultLocale: defaultLang,
        vueI18n: {
          fallbackLocale: defaultLang,
          messages
        },
        detectBrowserLanguage: false
      }
    ],
    [
      "nuxt-validate",
      {
        lang: defaultLang
      }
    ],
    ["@nuxtjs/robots"]
  ],
  // 'Crawl-Delay': 20
  // robots: {
  //   UserAgent: '*',
  //   Disallow: '',
  //   Sitemap: 'https://admin.fanarrealty.com/sitemap.xml'
  // },
  /*
   ** Build configuration
   */
  build: {
    transpile: [
      "vue-instantsearch",
      "instantsearch.js/es",
      /^vue2-google-maps($|\/)/
    ],
    plugins: [
      new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery",
        _: "lodash"
      })
    ],
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  }
};
