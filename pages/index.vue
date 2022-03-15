<template>
  <div class="home-page">
    <div class="hero-img relative">
      <img
        class="h-screen w-full"
        :src="'https://admin.fanarrealty.com/storage/'+settings.slider_image"
        alt="Al Fanar hero Image"
        v-if="settings.slider_image"
      />
      <div class="hero-content flex justify-center items-center absolute pin-x pin-y">
        <div class="container-content text-center">
          <h1 class="text-6xl text-white text-center mb-4" v-if="sectionTitle === 'name.ar'">
            {{settings.slider_title1_ar}}
            <br />
            {{settings.slider_title2_ar}}
          </h1>
          <h1 class="text-6xl text-white text-center mb-4" v-else-if="sectionTitle === 'name.en'">
            {{settings.slider_title1_en}}
            <br />
            {{settings.slider_title2_en}}
          </h1>
          <p
            class="text-white text-2xl md:text-base"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.slider_description_ar}}</p>
          <p
            class="text-white text-2xl md:text-base"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.slider_description_en}}</p>
        </div>
      </div>

      <SearchBox />
    </div>
    <div class="featured-offers overflow-hidden" v-if="featured.length">
      <div class="container-content">
        <div class="title text-center my-12">
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.offer_title_ar}}</h2>
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.offer_title_en}}</h2>
          <p
            class="text-blue-shadow"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.offer_description_ar}}</p>
          <p
            class="text-blue-shadow"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.offer_description_en}}</p>
        </div>
      </div>

      <div class="offers-slider mb-12 md:mb-6">
        <div>
          <carousel
            ref="projects-carousel"
            :rtl="rtl"
            :per-page="5"
            :perPageCustom="perPageCustom"
            :mouse-drag="true"
            :touch-drag="true"
            :paginationEnabled="true"
            :navigationEnabled="true"
            :navigationNextLabel="`<i class='fa fa-angle-right'></i>`"
            :navigationPrevLabel="`<i class='fa fa-angle-left'></i>`"
          >
            <slide v-for="(item,index) in featured" :key="index">
              <div class="px-4 mb-12 md:mb-6">
                <n-link
                  :to="localePath('properties')+'/istanbul'+'/'+item.slug"
                  class="no-underline text-main-color"
                >
                  <div class="max-w-sm rounded-lg shadow-lg">
                    <div class="relative">
                      <img
                        class="w-full rounded-tr-lg rounded-tl-lg offers-image"
                        :src="item.image"
                        :alt="item.image_alt"
                        :title="item.image_title"
                      />
                      <div
                        class="offer-tag absolute pin-t text-white text-sm rtl:pl-4 ltr:pr-4 rtl:pr-3 ltr:pl-3 py-4"
                        v-if="item.status"
                        :style="'background-color:' + item.status.color"
                      >{{item.status.name}}</div>
                      <div
                        class="property-expired p-4"
                        v-if="item.expired"
                      >{{$t('real_estate.expired')}}</div>
                    </div>
                    <div class="card-body px-2 py-2 pb-3">
                      <div class="flex flex-wrap items-center justify-between mb-2">
                        <div class="price w-2/5 ltr:text-right rtl:text-left">
                          <p
                            class="line-through rtl:text-right ltr:text-left text-red-color text-sm font-bold mb-2 md:text-sm md:ltr:pr-3 md:rtl:pl-3"
                            v-if="item.price"
                          >
                            <ConvertPrice :price="formatPrice(item.price)" />
                            {{symbol}}
                          </p>
                          <p
                            class="text-dark-blue text-lg font-bold rtl:text-right ltr:text-left sm:text-base"
                            v-if="item.price_after"
                          >
                            <ConvertPrice :price="formatPrice(item.price_after)" />
                            {{symbol}}
                          </p>
                        </div>
                        <p
                          class="text-blue-shadow w-3/5 text-sm rtl:text-left ltr:text-right"
                          v-if="item.municipality"
                        >
                          <span v-if="item.municipality.city">
                            <i class="fas fa-map-marker-alt text-brown-color"></i>
                            <span v-if="item.municipality.city.name">{{item.municipality.city.name}}</span> -
                            <span v-if="item.municipality.name">{{item.municipality.name}}</span>
                          </span>
                        </p>
                      </div>

                      <div class="offer-title flex flex-wrap">
                        <div class="w-full">
                          <h3 class="text-lg font-bold mb-2">
                            <truncate :length="75" clamp less type="html" :text="item.name"></truncate>
                          </h3>
                        </div>
                      </div>
                      <!-- offer-title -->
                      <div
                        class="offer-info mt-1 flex items-center content-center justify-center border-solid border rounded"
                      >
                        <div class="beds w-1/3 py-1">
                          <div class="text-center">
                            <img
                              src="/img/bed.svg"
                              class="text-dark-blue bed-icon mb-1"
                              alt="bed icon"
                            />
                            <p class="text-main-color text-xs font-bold">
                              <span class="pr-1">{{item.bedrooms}}</span>
                              {{$t('home.bedrooms')}}
                            </p>
                          </div>
                        </div>
                        <div class="house w-1/3 py-1">
                          <div class="text-center">
                            <img src="/img/home.svg" class="mb-1 home-icon" alt="home icon" />
                            <p class="text-main-color text-xs font-bold">
                              <span class="pr-1">{{item.total_area}}</span>
                              {{$t('home.m')}}
                              <sup>2</sup>
                            </p>
                          </div>
                        </div>
                        <div class="bathroom w-1/3 py-1">
                          <div class="text-center">
                            <img src="/img/bathroom.svg" class="bath-icon mb-1" alt="bathroom icon" />
                            <p class="text-main-color text-xs font-bold">
                              <span class="pr-1">{{item.bathrooms}}</span>
                              {{$t('home.bathrooms')}}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </n-link>
              </div>
            </slide>
          </carousel>
        </div>
      </div>

      <div class="show-all text-center mt-2 mb-10 md:mb-4">
        <n-link
          :to="'properties/istanbul'"
          class="no-underline text-dark-blue rounded-full border-solid py-4 px-12 md:px-8 md:py-2 hover:bg-dark-blue hover:text-white"
        >{{$t('home.see_all_offers')}}</n-link>
      </div>
    </div>

    <div class="shape md:hidden feature-shape">
      <img class="w-full" src="/img/bg.png" alt />
    </div>

    <div class="feature-projects" v-if="apartment.length">
      <div class="container-content">
        <div class="title text-center my-12 md:my-6">
          <h2
            class="text-dark-blue text-4xl font-bold mb-4"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.project_title_ar}}</h2>
          <h2
            class="text-dark-blue text-4xl font-bold mb-4"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.project_title_en}}</h2>
          <p
            class="text-blue-shadow w-1/2 mx-auto md:w-full"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.project_description_ar}}</p>
          <p
            class="text-blue-shadow w-1/2 mx-auto md:w-full"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.project_description_en}}</p>
        </div>
      </div>
      <div class="container-content">
        <div class="flex flex-wrap mb-2">
          <div
            v-for="(item,index) in apartment"
            :key="index"
            :class="index===0?'w-2/3 px-4 mb-8 md:w-full xs:w-full md:mb-4 md:px-2':'w-1/3 px-4 mb-8 xs:w-full md:w-1/2 md:mb-4 md:px-2'"
          >
            <div class="project-box overflow-hidden relative">
              <div class="overlay absolute pin flex items-center justify-center rounded-lg">
                <div class="text-center mx-8 md:mx-0 xs:w-full">
                  <div v-if="item.municipality">
                    <i class="fas fa-map-marker-alt text-light-blue mb-2"></i>
                    <p class="text-light-blue text-sm mb-4 md:text-xs">
                      {{item.municipality.city.name}} -
                      {{item.municipality.name}}
                    </p>
                  </div>

                  <p
                    class="text-white font-bold text-lg mb-4 mx-auto md:w-full md:px-4"
                  >{{item.name}}</p>
                  <n-link
                    class="rounded-full py-3 px-4 bg-white text-dark-blue start-from block mx-auto no-underline xs:w-4/5"
                    :to="'properties/istanbul'+'/'+item.slug"
                  >
                    {{$t('home.starting_from')}}
                    <span
                      class="text-main-color font-bold ltr:pl-2 rtl:pr-2"
                      v-if="item.price"
                    >
                      <ConvertPrice :price="formatPrice(item.price)" />
                      {{symbol}}
                    </span>
                  </n-link>
                </div>
              </div>
              <img
                class="w-full h-full rounded-lg"
                :src="item.image"
                :alt="item.image_alt"
                :title="item.image_title"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="show-all text-center mt-16 mb-4 md:mt-6">
        <n-link
          :to="localePath('properties')+'/istanbul'"
          class="no-underline text-dark-blue rounded-full border-solid py-4 px-12 md:px-8 md:py-2 hover:bg-dark-blue hover:text-white"
        >{{$t('home.see_all_projects')}}</n-link>
      </div>
    </div>

    <div class="shape -mt-8 md:hidden">
      <img class="w-full" src="/img/bg2.png" alt />
    </div>

    <div class="contact-us pb-16 md:pb-8">
      <div class="container-content">
        <div class="title text-center pt-20 mb-6 md:pt-8">
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.contact_title_ar}}</h2>
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.contact_title_en}}</h2>
          <p
            class="text-main-color w-1/2 mx-auto md:w-full uppercase font-bold"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.contact_description_ar}}</p>
          <p
            class="text-main-color w-1/2 mx-auto md:w-full uppercase font-bold"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.contact_description_en}}</p>
        </div>
        <div class="w-full max-w-xs mx-auto">
          <form novalidate @submit.prevent="validateBeforeSubmit">
            <div class="mb-4">
              <label class="block text-main-color text-sm font-bold mb-2" for="phone-number">
                {{$t('home.phone_number')}}
                <span class="required">*</span>
              </label>
              <div
                class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                :class="{ 'has-danger': errors.has('mobile') }"
              >
                <div class="input-number flex items-center w-2/6">
                  <i class="fas fa-phone text-dark-blue ltr:pr-1 rtl:pl-1"></i>
                  <vue-country-code
                    class="text-blue-shadow text-sm w-full bg-transparent"
                    :disabledFetchingCountry="true"
                    :defaultCountry="'TR'"
                    :enabledCountryCode="true"
                    @onSelect="onSelect"
                  ></vue-country-code>
                  <!--                  <input class="text-blue-shadow text-sm w-full bg-transparent" readonly-->
                  <!--                         placeholder="00970" v-model="call.code">-->
                </div>
                <input
                  class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3 bg-transparent"
                  id="phone-number"
                  type="text"
                  :placeholder="$t('home.phone_number')"
                  v-validate="'required|numeric'"
                  name="mobile"
                  v-model="call.mobile"
                />
              </div>
            </div>
            <div class="flex items-center justify-center mt-6">
              <button
                class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full"
                type="submit"
              >{{$t('home.send')}}</button>
            </div>
            <div
              class="text-red block mt-4"
              v-if="errors.firstRule('mobile')"
            >{{ errors.first('mobile') }}</div>
            <div
              :class="success===true?'':'hidden'"
              class="bg-red-100 border border-green text-green px-4 py-3 rounded relative"
              role="alert"
            >
              <span class="block">{{$t('home.sent_successfully')}}</span>
            </div>
            <div
              :class="error===true?'':'hidden'"
              class="bg-red-100 border border-red text-red px-4 py-3 rounded relative"
              role="alert"
            >
              <span class="block">{{errorMsgs}}</span>
            </div>
          </form>
        </div>
      </div>
    </div>

    <VideoSlider />

    <div class="our-blog pb-20">
      <div class="container-content">
        <div class="title text-center my-12">
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.blog_title_ar}}</h2>
          <h2
            class="text-dark-blue text-4xl font-bold"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.blog_title_en}}</h2>
          <p
            class="text-blue-shadow w-1/2 mx-auto md:w-full"
            v-if="sectionTitle === 'name.ar'"
          >{{settings.blog_description_ar}}</p>
          <p
            class="text-blue-shadow w-1/2 mx-auto md:w-full"
            v-else-if="sectionTitle === 'name.en'"
          >{{settings.blog_description_en}}</p>
        </div>
      </div>
      <div class="container-content md:hidden">
        <div class="flex items-center justify-center flex-wrap">
          <div
            v-for="(item,index) in blogs"
            :key="index"
            class="w-1/3 md-lg:w-1/2 md-lg:mb-6 px-4 md:px-2"
            itemscope
            itemtype="http://schema.org/NewsArticle"
          >
            <div class="max-w-sm rounded-lg overflow-hidden">
              <div
                itemprop="image"
                itemscope
                itemtype="http://schema.org/ImageObject"
                v-if="item.image"
              >
                <meta itemprop="height" content="200" />
                <meta itemprop="width" content="200" />
                <meta itemprop="url" :content="item.image" />
                <n-link :to="localePath('blog')+'/'+item.slug">
                  <img class="w-full" :src="item.image" />
                </n-link>
              </div>
              <div class="card-body px-4 py-4 bg-white">
                <div class="offer-title pb-4">
                  <n-link
                    :to="localePath('blog')+'?type='+(item.type==='blog'?1:2)"
                    class="no-underline"
                  >
                    <span
                      class="rounded-full py-2 px-4 tag uppercase text-white text-xs font-bold"
                      :class="item.type==='blog'?'bg-dark-blue':'bg-brown-color'"
                    >{{item.type}}</span>
                  </n-link>
                  <h3 class="text-lg font-bold mb-2 mt-6" itemprop="headline">
                    <n-link
                      :to="localePath('blog')+'/'+item.slug"
                      class="no-underline text-main-color"
                    >{{item.title}}</n-link>
                  </h3>
                  <p
                    class="text-xs font-bold text-blue-shadow text-xs mb-4"
                    v-if="item.created_at"
                    itemprop="datePublished"
                    :content="item.created_at"
                  >{{item.created_at}}</p>
                  <truncate
                    class="text-sm text-blue-shadow font-bold leading-normal"
                    itemprop="description"
                    :length="75"
                    clamp
                    less
                    type="html"
                    :text="'<p>'+item.description+'</p>'"
                  ></truncate>
                </div>
                <!-- offer-title -->
                <span itemprop="author" class="sr-only">الفنار العقارية</span>
                <div
                  itemprop="publisher"
                  itemscope
                  itemtype="http://schema.org/Organization"
                  class="sr-only"
                >
                  <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                    <meta itemprop="url" content="/img/fanar-logo.png" />
                    <img src="/img/fanar-logo.png" alt="ImageLogo" />
                  </div>
                  <span itemprop="name">الفنار العقارية</span>
                </div>
                <div class="more-details text-center pt-4">
                  <n-link
                    :to="localePath('blog')+'/'+item.slug"
                    class="text-dark-blue font-bold text-sm no-underline"
                  >{{$t('blogs.read_more')}}</n-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <MobileBlog />

      <div class="show-all text-center mt-16 mb-4 md:mt-10">
        <n-link
          :to="localePath('blog')"
          class="no-underline text-dark-blue rounded-full border-solid py-4 px-12 md:px-8 md:py-2 hover:bg-dark-blue hover:text-white"
        >{{$t('home.all_blogs_&_news')}}</n-link>
      </div>
    </div>

    <div class="squares md:hidden">
      <div class="container-content">
        <img class="w-full" src="/img/squares.png" alt />
      </div>
    </div>

    <div class="container-content">
      <Subscribe />
    </div>

    <ContactUs />
  </div>
</template>
<script>
import Carousel from "vue-carousel/src/Carousel.vue";
import Slide from "vue-carousel/src/Slide.vue";
import VideoSlider from "~/components/video-slider";
import SearchBox from "~/components/search2";
import Subscribe from "~/components/subscribe";
import ContactUs from "~/components/contact-us";
import MobileBlog from "~/components/mobile-blog";
import axios from "~/plugins/axios.js";
import algoliasearch from "algoliasearch/lite";
import { history as historyRouter } from "instantsearch.js/es/lib/routers";
import { simple as simpleMapping } from "instantsearch.js/es/lib/stateMappings";
import ConvertPrice from "~/components/ConvertPrice";
import truncate from "vue-truncate-collapsed";
import "vue-country-code/dist/vue-country-code.css";

import { createInstantSearch } from "vue-instantsearch";

const searchClient = algoliasearch(
  "RJ3KVXJDS0",
  "aa87273b8cf837f15bb3dbf00be5311d"
);

const { instantsearch, rootMixin } = createInstantSearch({
  searchClient,
  indexName: "apartments",
  routing: {
    router: historyRouter(),
    stateMapping: simpleMapping()
  }
});

export default {
  beforeMount() {
    // Nuxt will merge `asyncData` and `data` on the client
    instantsearch.hydrate(this.algoliaState);
  },
  mixins: [rootMixin],
  head() {
    return {
      title: this.$t("app.name") + " - " + this.title,
      meta: this.page.seo,
      bodyAttrs: {
        class: "custom-header"
      },
      __dangerouslyDisableSanitizers: ["script"],
      script: [
        {
          innerHTML: JSON.stringify(this.structuredData),
          type: "application/ld+json"
        }
      ]
    };
  },
  data() {
    return {
      x: "fa fa-search",
      perPageCustom: [[1600, 5], [1400, 4], [991, 3], [576, 2], [300, 1]],
      success: false,
      error: false,
      call: {
        mobile: "",
        code: "",
        page: this.$route.path
      },
      errorMsgs: [],
      structuredData: {
        "@context": "http://schema.org",
        "@type": "Corporation",
        legalName: "Fanar Reatlty",
        url: "https://www.fanarrealty.com/",
        logo: "https://www.fanarrealty.com/img/fanar-logo.png",
        contactPoint: [
          {
            "@type": "ContactPoint",
            telephone: "+90 539 591 99 99",
            contactType: "customer service",
            areaServed: "TRY"
          }
        ],
        address: {
          "@type": "PostalAddress",
          addressLocality: "Istanbul",
          postalCode: "34490",
          streetAddress:
            "Fulya Mahallesi, Büyükdere Cd. Torun Center Ofis Tower No: 74D, No: 19, 34394 Şişli",
          addressCountry: "Turkey"
        },

        sameAs: [
          "https://www.facebook.com/FanarRealty/",
          "https://twitter.com/fanarrealty",
          "https://www.instagram.com/fanarrealty/",
          "https://www.youtube.com/channel/UCsem_L0zuyGHjD_fD8rBC9Q"
        ]
      },
      sectionTitle: "name." + this.$store.app.i18n.locale
    };
  },
  components: {
    Carousel,
    Slide,
    VideoSlider,
    SearchBox,
    ContactUs,
    MobileBlog,
    Subscribe,
    createInstantSearch,
    ConvertPrice,
    truncate
  },
  async asyncData({ store, error }) {
    const $apartment_type = "apartment_type.name." + store.app.i18n.locale;
    const $price = "meta.price." + store.app.i18n.locale;
    const $rooms = "meta.rooms." + store.app.i18n.locale;
    const $area = "meta.area." + store.app.i18n.locale;
    let res = await Promise.all([
      store.dispatch("getCurrentPage", "home"),
      store.dispatch("getVideos", store.app.i18n._vm.locale),
      store.dispatch("getBlogs", store.app.i18n._vm.locale),
      store.dispatch("getFeatured", store.app.i18n._vm.locale),
      store.dispatch("getApartment", store.app.i18n._vm.locale),
      store.dispatch("getPage", {
        lang: store.app.i18n._vm.locale,
        page: "home"
      })
    ]);
    return instantsearch
      .findResultsState({
        query: "",
        hitsPerPage: 15,
        disjunctiveFacets: [$apartment_type, $price, $rooms, $area]
      })
      .then(() => ({
        algoliaState: instantsearch.getState()
      }));
  },
  computed: {
    settings() {
      return this.$store.state.settings;
    },
    page() {
      return this.$store.state.page;
    },
    rtl() {
      return this.$store.app.i18n._vm.locale === "ar" ? true : false;
    },
    blogs() {
      return _.slice(this.$store.state.blogs, 0, 3);
    },
    featured() {
      return this.$store.state.featured;
    },
    apartment() {
      return this.$store.state.apartment;
    },
    symbol() {
      return this.$store.state.symbol;
    },
    title() {
      return this.page ? this.page.title : this.$t("links.home");
      // const item = this.page.seo.find((x => {
      //   return x.name === 'title'
      // }));
      // return item ? item.content : this.$t('links.home');
    }
  },
  methods: {
    onSelect({ name, iso2, dialCode }) {
      this.call.code = dialCode;
    },
    validateBeforeSubmit(event) {
      this.$validator.resume();
      this.$validator.validate().then(result => {
        if (result) {
          axios
            .post("/api/call", {
              code: this.call.code,
              mobile: this.call.mobile,
              page: this.call.page
            })
            .then(res => {
              this.success = true;
              const $this = this;
              setTimeout(function() {
                $this.call = {
                  mobile: null
                };
                $this.$validator.pause();
                $this.success = false;
              }, 3000);
            })
            .then(() => {
              this.errors.clear();
            })
            .catch(res => {
              this.error = true;
              const $this = this;
              // if (res.response.data.errors.code) {
              //   this.errorMsgs = res.response.data.errors.code[0];
              // }
              // if (res.response.data.errors.mobile) {
              //   this.errorMsgs = res.response.data.errors.mobile[0];
              // }
              setTimeout(function() {
                $this.error = false;
              }, 3000);
            });
          return;
        }
      });
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  },
  mounted() {
    // window.main.init();
  }
};
</script>
<style lang="scss">
.VueCarousel-navigation-button {
  transform: none !important;
  width: 30px;
  height: 30px;
  background-color: #3489d8 !important;
  display: block;
  opacity: 1 !important;
  color: #fff !important;
  padding: 0 !important;
  outline: none !important;
  border-radius: 50%;
  transition: all 0.25s;
  top: 33% !important;

  &:hover {
    background-color: #cea660 !important;
  }
}

.feature-shape {
  height: 60px;
}
.VueCarousel-pagination {
  @include respond-to(576px) {
    background: rgba(0, 0, 0, 0.025);
  }
}

.VueCarousel-dot-container {
  margin-top: 0 !important;
}

.VueCarousel-dot {
  margin-top: 0 !important;
  background-color: #bfbfbf !important;
}

.VueCarousel-dot--active {
  background-color: #3489d8 !important;
}

.vue-country-select .country-code {
  color: #666 !important;
  padding-#{$opDir}: 4px !important;
  font-size: 14px !important;
  font-weight: bold !important;
}

.vue-country-select {
  border: none !important;
}

.vue-country-select .dropdown-list {
  border: none !important;
  box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.4) !important;
}

.vue-country-select .dropdown-arrow {
  padding-#{$opDir}: 5px !important;
  color: #3489d8 !important;
}

.home-page {
  position: relative;
  background-color: #f7f7f7;

  .hero-content {
    h2 {
      @include respond-to-min-max-width(767px, 991px) {
        font-size: 38px !important;
      }
    }
  }

  h3 {
    cursor: pointer;

    a {
      @include transition_default();
    }

    &:hover {
      a {
        @include transition_default();
        color: #cea660;
      }
    }
  }
}

.custom-height {
  height: 32px;
}

.more-details {
  a:hover {
    @include transition_default();
    color: #3489d8;
  }
}

.our-blog {
  img {
    height: 220px;
    object-fit: cover;
  }

  .more-details {
    a:hover {
      @include transition_default();
      color: #cea660;
    }
  }

  .card-body {
    min-height: 250px;
    @include respond-to(991px) {
      height: auto;
    }
    @include respond-to(991px) {
      min-height: 190px;
    }

    h3 {
      height: 50px;
      overflow: hidden;
    }
  }
}

.hero-img {
  img {
    object-fit: cover;
    @include respond-to(576px) {
      height: 85vh;
    }
    @include respond-to(320px) {
      height: 100vh;
    }
  }
}

.overlay {
  background-color: rgba(0, 0, 0, 0.5);
}

.offers-slider {
  .offers-image {
    height: 280px;
    object-fit: cover;
    @include respond-to(576px) {
      height: 220px;
    }
  }

  .offer-title {
    h3 {
      height: 44px;
      overflow: hidden;
      @include respond-to(991px) {
        width: 100%;
      }
    }
  }
}

.show-all {
  position: relative;
  z-index: 2;

  a {
    border: 1px solid #e6e6e6;
    font-size: 14px;
    font-weight: bold;
    @include transition_default();
  }
}

.offer-info {
  border-color: #f0f0f0;

  html[dir="ltr"] .beds,
  .house {
    border-right: 1px solid #f0f0f0;
  }

  html[dir="rtl"] .beds,
  .house {
    border-left: 1px solid #f0f0f0;
  }
}

.project-box {
  height: 360px;
  @include respond-to(576px) {
    height: 220px;
  }

  img {
    object-fit: cover;
  }

  .start-from {
    @include transition_default();

    &:hover {
      background-color: #3489d8;
      color: #fff;

      span {
        color: #fff;
      }
    }
  }
}

.our-blog {
  .offer-title {
    border-bottom: 1px solid #f2f2f2;
  }

  .card-body {
    margin-top: -2px;
  }
}

.squares {
  .container-content {
    width: 95%;
  }

  img {
    height: 125px;
    object-fit: contain;
  }
}

form {
  input {
    &:focus {
      box-shadow: none;
      outline: none;
    }
  }
}

.input-handler {
  border-color: #398ddb;
}

html[dir="ltr"] .input-handler .input-number {
  border-right: 1px solid #e6e6e6;
}

html[dir="rtl"] .input-handler .input-number {
  border-left: 1px solid #e6e6e6;
}

.subscribe {
  margin-top: -52px;
}

.featured-offers {
  h3 {
    font-size: 16px !important;
  }
}

.responsive-offers {
  @include respond-to-min-width(576px) {
    display: none;
  }

  h3 {
    font-size: 16px !important;
  }
}

.modal-video {
  padding: 0 50px;
  @include respond-to(576px) {
    padding: 0 10px;
  }
}
</style>
