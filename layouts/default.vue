<template>
  <div>
    <noscript>
      <iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-T76FWVK"
        height="0"
        width="0"
        style="display:none;visibility:hidden"
      ></iframe>
    </noscript>
    <Header />
    <div class="main-wrapper">
      <Nuxt />
    </div>
    <Footer />

    <div
      :class="show?'active':''"
      class="fixed z-50 pin flex items-center justify-center popup-custom"
    >
      <div>
        <div class="absolute pin bg-black opacity-75"></div>
      </div>
      <div class="relative">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-2xl px-6 py-6">
          <div
            v-for="(item,index) in popups"
            :class="currentPage===item.page?'':'hidden'"
            :key="index"
          >
            <h2
              class="font-semibold text-gray-900 text-xl leading-tight border-b-2 border-gray-200 pb-4"
            >{{item.title}}</h2>
            <div class="mt-4">
              <a :href="item.link" class="max-w-full">
                <img :src="item.image" alt="image" />
              </a>
            </div>
          </div>
          <div class="text-center border-t-2 border-gray-200 mt-3 pt-3">
            <button
              @click.prevent="closeModal"
              class="px-4 py-2 text-gray-800 font-semibold bg-white hover:bg-gray-100 border rounded focus:outline-none focus:shadow-outline"
            >{{$t('app.close')}}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "~/components/Header";
import Footer from "~/components/Footer";

export default {
  components: {
    Header,
    Footer
  },
  data() {
    return {
      show: false
    };
  },
  head() {
    return {
      link: [
        {
          rel: "canonical",
          href: "https://fanarrealty.com" + this.$route.path
        }
      ],
      htmlAttrs: {
        lang: this.$i18n.locale,
        dir: this.$i18n.locale === "en" ? "ltr" : "rtl"
      },
      script: [
        {
          innerHTML: `(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start':
            new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-T76FWVK');`
        }
      ],
      __dangerouslyDisableSanitizers: ["script"]
    };
  },
  methods: {
    showModal($time) {
      const $this = this;
      const $timer = $time ? $time : 10;
      setTimeout(function() {
        $this.show = true;
      }, $timer * 1000);
    },
    closeModal() {
      this.show = false;
    }
  },
  watch: {
    "$route.path": function($val) {
      if (this.currentPopup) {
        this.showModal(this.currentPopup.seconds);
      }

      if (process.client) {
        document
          .getElementsByTagName("body")[0]
          .classList.remove("body-overflow");
        document
          .getElementsByClassName("hamburger")[0]
          .classList.remove("active");
        document
          .getElementsByClassName("hamburger")[0]
          .classList.add("unactive");
        document
          .getElementsByClassName("menu-grid")[0]
          .classList.remove("active");
      }
    }
  },
  computed: {
    popups() {
      return this.$store.state.popups;
    },
    currentPage() {
      return this.$store.state.currentPage;
    },
    currentPopup() {
      return this.popups.find(x => {
        return x.page === this.currentPage;
      });
    }
  },
  mounted() {
    if (this.currentPopup) {
      this.showModal(this.currentPopup.seconds);
    }
  }
};
</script>

<style lang="scss">
.popup-custom {
  transition: all 0.35s;
  opacity: 0;
  visibility: hidden;

  &.active {
    opacity: 1;
    visibility: visible;
  }
}
</style>
