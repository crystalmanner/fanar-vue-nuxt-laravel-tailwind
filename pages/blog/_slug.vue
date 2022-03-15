<template>
  <div class="padding-menu">
    <div class="blog-details-page pt-8">
      <div class="container-content">
        <div class="flex flex-wrap -mx-4">
          <div class="left-side px-4">
            <article
              class="blog-details bg-white rounded-lg px-4 py-8 pb-2"
              itemscope
              itemtype="http://schema.org/NewsArticle"
            >
              <span
                class="rounded-full py-2 px-4 tag bg-dark-blue uppercase text-white text-xs font-bold"
              >{{blog.type}}</span>
              <h1 class="text-dark-blue text-3xl my-4" itemprop="headline">{{blog.title}}</h1>
              <div
                class="-mx-4 my-2"
                itemprop="image"
                itemscope
                itemtype="http://schema.org/ImageObject"
                v-if="blog.image"
              >
                <meta itemprop="height" content="200" />
                <meta itemprop="width" content="200" />
                <meta itemprop="url" :content="blog.image" />
                <img
                  class="w-full blog-img"
                  :src="blog.image"
                  :alt="blog.image_alt"
                  :title="blog.image_title"
                  itemprop="image"
                />
              </div>
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

              <div
                class="publish-time flex justify-between items-center md:flex-wrap p-4 -mx-4 px-4"
              >
                <div class="publish-date md:w-full md:mb-4">
                  <p class="text-sm text-main-color font-bold md:text-xs">
                    {{$t('blogs.Source_here')}}:
                    <span class="text-blue-shadow">
                      <time
                        :datetime="blog.created_at_meta"
                        itemprop="datePublished"
                      >{{blog.created_at}}</time>
                    </span>
                  </p>
                </div>
                <div class="blog-share flex items-center justify-between md:w-full">
                  <span class="text-main-color text-sm ltr:pr-4 rtl:pl-4">Share</span>
                  <social-sharing :url="siteURL+localePath('blog')+'/'+blog.slug" inline-template>
                    <div class="list-reset flex items-center">
                      <network
                        network="facebook"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </network>
                      <network
                        network="twitter"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-twitter"></i>
                        </a>
                      </network>
                      <network
                        network="linkedin"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </network>
                    </div>
                  </social-sharing>
                </div>
              </div>
              <div class="editor-text text-justify" itemprop="description">
                <div v-html="blog.table_of_content" class="table-content"></div>
                <div v-html="blog.details"></div>
              </div>

              <div
                class="article-footer flex justify-between items-center md:flex-wrap p-4 -mx-4 px-4"
              >
                <div class="publish-date md:w-full md:mb-4">
                  <div class="blog-tags" v-if="blog.keywords">
                    <span
                      v-for="(tag) in blog.keywords"
                      :key="tag"
                      class="rounded-full no-underline py-2 px-4 tag text-main-color text-xs font-bold ltr:mr-1 rtl:ml-1"
                      itemprop="keywords"
                    >{{tag}}</span>
                  </div>
                </div>
                <div class="blog-share flex items-center justify-between md:w-full">
                  <span class="text-main-color text-sm ltr:pr-4 rtl:pl-4">Share</span>
                  <social-sharing :url="siteURL+localePath('blog')+'/'+blog.slug" inline-template>
                    <div class="list-reset flex items-center">
                      <network
                        network="facebook"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </network>
                      <network
                        network="twitter"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-twitter"></i>
                        </a>
                      </network>
                      <network
                        network="linkedin"
                        class="item mr-2 bg-dark-blue rounded cursor-pointer"
                      >
                        <a class="text-white">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </network>
                    </div>
                  </social-sharing>
                </div>
              </div>
            </article>
            <div class="mt-6">
              <Subscribe />
            </div>
          </div>

          <aside class="right-side px-4">
            <div class="md-lg:flex md-lg:flex-wrap md-lg:items-stretch">
              <div class="aside-img mb-6 md-lg:w-1/2 md-lg:px-4">
                <a :href="settings.article_promotion_link?settings.article_promotion_link:'/'">
                  <img
                    class="w-full h-56 rounded-lg"
                    :src="settings.article_promotion_image?settings.article_promotion_image:'/img/aside-img.png'"
                    alt="Sunset in the mountains"
                  />
                </a>
              </div>
              <div
                class="contact-box bg-white rounded-lg text-center flex items-center mb-6 md-lg:w-1/2 md-lg:px-4"
              >
                <div class="card w-full">
                  <div class="card-body bg-white rounded-lg py-8 px-6">
                    <p class="text-dark-blue text-sm">
                      {{$t('home.leave_your_contact_information')}}
                      <br />
                      <span class="font-bold">{{$t('home.and_we_will_get_back_to_you')}}</span>
                    </p>
                    <form
                      class="ltr:text-left rtl:text-right mt-4"
                      novalidate
                      @submit.prevent="validateBeforeSubmit"
                    >
                      <div class="mb-4">
                        <label
                          class="block text-main-color text-xs font-bold mb-2"
                          for="phone-number"
                        >
                          {{$t('home.phone_number')}}
                          <span class="required">*</span>
                        </label>
                        <div
                          class="input-handler relative border rounded-full w-full py-2 px-4 flex"
                          :class="{ 'has-danger': errors.has('mobile') }"
                        >
                          <div class="input-number flex items-center w-2/6">
                            <vue-country-code
                              class="text-blue-shadow text-sm w-full bg-transparent"
                              :enabledCountryCode="true"
                              :defaultCountry="'TR'"
                              :disabledFetchingCountry="true"
                              @onSelect="onSelect"
                            ></vue-country-code>
                          </div>
                          <input
                            class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3 w-full"
                            id="phone-number"
                            type="text"
                            :placeholder="$t('home.phone_number')"
                            v-validate="'required|numeric'"
                            v-model="call.mobile"
                            name="mobile"
                          />
                        </div>
                        <div
                          class="text-red block"
                          v-if="errors.firstRule('mobile')"
                        >{{ errors.first('mobile') }}</div>
                      </div>
                      <div class="mb-4">
                        <label
                          class="block text-main-color text-xs font-bold mb-2"
                          for="phone-number"
                        >{{$t('home.your_name')}}</label>
                        <div
                          class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                        >
                          <input
                            class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                            type="text"
                            :placeholder="$t('home.your_name')"
                            v-model="call.name"
                          />
                        </div>
                      </div>
                      <div class="mb-4">
                        <label
                          class="block text-main-color text-xs font-bold mb-2"
                          for="phone-number"
                        >{{$t('home.your_email')}}</label>
                        <div
                          class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                          :class="{ 'has-danger': errors.has('email') }"
                        >
                          <input
                            class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                            type="text"
                            :placeholder="$t('home.your_email')"
                            v-validate="'email'"
                            name="email"
                            v-model="call.email"
                          />
                        </div>
                        <div
                          class="text-red block"
                          v-if="errors.firstRule('email')"
                        >{{ errors.first('email') }}</div>
                      </div>
                      <div class="flex items-center justify-center mt-6">
                        <button
                          class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full"
                          type="submit"
                        >{{$t('home.send')}}</button>
                      </div>
                      <div
                        :class="success===true?'':'hidden'"
                        class="bg-red-100 border border-green text-green px-4 py-3 rounded relative"
                        role="alert"
                      >
                        <span class="block">{{$t('home.sent_successfully')}}</span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div
                class="features-side bg-white rounded-lg pt-6 pb-2 px-4 mb-6"
                v-if="featured.length"
              >
                <h3
                  class="text-lg font-bold text-main-color pb-2 text-sm font-bold text-main-color -mx-4 px-4 aside-title"
                >{{$t('home.featured_offers')}}</h3>
                <div class="md-lg:flex md-lg:flex-wrap pt-8">
                  <div
                    class="w-full md-lg:w-1/2 md-lg:px-4 mb-4"
                    v-for="(item,index) in featured"
                    :key="index"
                  >
                    <n-link
                      :to="localePath('properties')+'/istanbul'+'/'+item.slug"
                      class="no-underline"
                    >
                      <div class="max-w-sm rounded-lg">
                        <div class="relative">
                          <img
                            class="w-full rounded-tr-lg rounded-tl-lg my-aside-img"
                            :src="item.image"
                            :alt="item.image_alt"
                            :title="item.image_title"
                          />
                          <div
                            class="offer-tag absolute pin-l pin-t text-white text-sm ltr:pl-4 rtl:pr-4 ltr:pr-3 rtl:pl-3 py-2"
                            :class="item.status.id===2?'red':'green'"
                            v-if="item.status"
                          >{{item.status.name}}</div>
                        </div>
                        <div class="card-body px-4 py-4">
                          <div class="flex flex-wrap items-center justify-between mb-2">
                            <div class="price w-2/5 ltr:text-right rtl:text-left">
                              <p
                                class="line-through text-red-color text-xs font-bold rtl:text-right ltr:text-left mb-2"
                                v-if="item.price"
                              >
                                <ConvertPrice :price="formatPrice(item.price)" />
                                {{symbol}}
                              </p>
                              <p
                                class="text-dark-blue text-base font-bold rtl:text-right ltr:text-left"
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
                                <span
                                  v-if="item.municipality.city.name"
                                >{{item.municipality.city.name}}</span> -
                                <span v-if="item.municipality.name">{{item.municipality.name}}</span>
                              </span>
                            </p>
                          </div>

                          <div class="offer-title flex flex-wrap">
                            <div class="w-full">
                              <h3 class="text-sm mb-2 text-main-color font-bold">
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
                                <img
                                  src="/img/bathroom.svg"
                                  class="bath-icon mb-1"
                                  alt="bathroom icon"
                                />
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
                </div>
                <div class="text-center">
                  <button
                    class="bg-dark-blue text-white rounded-full py-2 px-4 text-base"
                    v-if="featuredCount < totalFeaturedCount"
                    @click="loadMoreFeatures()"
                  >{{$t('real_estate.load_more')}}</button>
                </div>
              </div>
              <div
                class="search-box bg-white rounded-lg pt-6 pb-2 px-4 mb-6 md-lg:w-1/2 md-lg:px-2"
              >
                <h3
                  class="text-sm font-bold text-main-color pb-8 border-b -mx-4 px-4"
                >Search for Real Estate</h3>
                <form @submit.prevent="submitSearch">
                  <no-ssr>
                    <ais-instant-search-ssr>
                      <ul class="filter-search list-reset">
                        <li
                          class="border-b py-4 -mx-4 px-4 relative"
                          :class="{ active : active_el === 1 }"
                          @click="activate(1)"
                        >
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span
                              class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal"
                            >{{$t('home.apartment_type')}}</span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"
                            ></i>
                          </div>
                          <ais-refinement-list :attribute="apartment_type" />
                        </li>
                        <li
                          class="border-b py-4 -mx-4 px-4 relative"
                          :class="{ active : active_el === 2 }"
                          @click="activate(2)"
                        >
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span
                              class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal"
                            >{{$t('home.bedrooms')}}</span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"
                            ></i>
                          </div>
                          <ais-refinement-list :attribute="rooms" />
                          <!--                          <ais-numeric-menu-->
                          <!--                            attribute="bedrooms"-->
                          <!--                            :items="[-->
                          <!--                              {label: $t('home.all') },-->
                          <!--                              {label: $t('home.studio'), end: 0},-->
                          <!--                              {label: $t('home.lounge_&_room'), end: 1, start: 1},-->
                          <!--                              {label: $t('home.lounge_&_2rooms'), end: 2, start: 2},-->
                          <!--                              {label: $t('home.lounge_&_3rooms'), end: 3, start: 3},-->
                          <!--                              {label: $t('home.lounge_&_4rooms'), end: 4, start: 4},-->
                          <!--                              {label: $t('home.lounge_&_more_than_4rooms'), start: 5},-->
                          <!--                          ]"-->
                          <!--                          >-->
                          <!--                            <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                          <!--                              <li v-for="item in items" :key="item.value">-->
                          <!--                                <a-->
                          <!--                                  :href="createURL(item.value)"-->
                          <!--                                  :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                          <!--                                  :class="item.isRefined ? 'active' : ''"-->
                          <!--                                  @click.prevent="refine(item.value)"-->
                          <!--                                >-->
                          <!--                                  {{ item.label }}-->
                          <!--                                </a>-->
                          <!--                              </li>-->
                          <!--                            </ul>-->
                          <!--                          </ais-numeric-menu>-->
                        </li>
                        <li
                          class="border-b py-4 -mx-4 px-4 relative"
                          :class="{ active : active_el === 3 }"
                          @click="activate(3)"
                        >
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span
                              class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal"
                            >{{$t('home.price')}}</span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"
                            ></i>
                          </div>
                          <ais-refinement-list :attribute="price" />
                        </li>
                        <li
                          class="py-4 -mx-4 px-4 relative"
                          :class="{ active : active_el === 4 }"
                          @click="activate(4)"
                        >
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span
                              class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal"
                            >{{$t('home.total_area')}}</span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"
                            ></i>
                          </div>
                          <ais-refinement-list :attribute="area" />
                          <!--                          <ais-numeric-menu-->
                          <!--                            attribute="total_area"-->
                          <!--                            :items="[-->
                          <!--                              {label: $t('home.all')},-->
                          <!--                              {label: $t('home.less_than')+' 50 '+$t('home.m2'), end: 50},-->
                          <!--                              {label: $t('home.between')+' 50 '+ $t('home.m2') +' '+$t('home.and')+' 100 '+ $t('home.m2'), end: 100, start: 50},-->
                          <!--                              {label: $t('home.between')+' 100 '+ $t('home.m2') +' '+$t('home.and')+' 150 '+ $t('home.m2'), end: 150, start: 100},-->
                          <!--                              {label: $t('home.between')+' 150 '+ $t('home.m2') +' '+$t('home.and')+' 200 '+ $t('home.m2'), end: 200, start: 150},-->
                          <!--                              {label: $t('home.between')+' 200 '+ $t('home.m2') +' '+$t('home.and')+' 250 '+ $t('home.m2'), end: 250, start: 200},-->
                          <!--                              {label: $t('home.more_than')+' 250 '+ $t('home.m2'), start: 250},-->
                          <!--                          ]"-->
                          <!--                          >-->
                          <!--                            <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                          <!--                              <li v-for="item in items" :key="item.value">-->
                          <!--                                <a-->
                          <!--                                  :href="createURL(item.value)"-->
                          <!--                                  :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                          <!--                                  :class="item.isRefined ? 'active' : ''"-->
                          <!--                                  @click.prevent="refine(item.value)"-->
                          <!--                                >-->
                          <!--                                  {{ item.label }}-->
                          <!--                                </a>-->
                          <!--                              </li>-->
                          <!--                            </ul>-->
                          <!--                          </ais-numeric-menu>-->
                        </li>
                        <div class="text-center search-icon -mx-4">
                          <button
                            type="submit"
                            class="h-full w-full text-white rounded-b-lg text-2xl no-underline py-4 -mb-2 px-4 bg-dark-blue"
                          >
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </ul>
                    </ais-instant-search-ssr>
                  </no-ssr>
                </form>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
    <ContactUs />
  </div>
</template>

<script>
import axios from "~/plugins/axios.js";
import Subscribe from "~/components/subscribe";
import "vue-select/dist/vue-select.css";
import SocialSharing from "vue-social-sharing";
import algoliasearch from "algoliasearch/lite";
import { history as historyRouter } from "instantsearch.js/es/lib/routers";
import { simple as simpleMapping } from "instantsearch.js/es/lib/stateMappings";
import truncate from "vue-truncate-collapsed";
import ConvertPrice from "~/components/ConvertPrice";
import ContactUs from "~/components/contact-us";
import {
  AisInstantSearchSsr,
  AisRefinementList,
  AisNumericMenu,
  createInstantSearch
} from "vue-instantsearch";

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
    instantsearch.hydrate(this.algoliaState);
  },
  mixins: [rootMixin],
  data() {
    return {
      apartment_type: "apartment_type.name." + this.$store.app.i18n.locale,
      rooms: "meta.rooms." + this.$store.app.i18n.locale,
      price: "meta.price." + this.$store.app.i18n.locale,
      area: "meta.area." + this.$store.app.i18n.locale,
      bedrooms: "",
      total_area: "",
      active_el: null,
      call: {
        mobile: "",
        code: "",
        name: "",
        email: "",
        page: this.$route.path
      },
      success: false,
      error: false,
      featuredCount: 3
    };
  },
  methods: {
    getPrice(price) {
      if (this.$store.state.currency === "try") return price;
      else
        return parseFloat(
          (price / this.$store.state.currentRate).toString()
        ).toFixed(2);
    },
    selectBedroom(item) {
      this.bedrooms = item;
    },
    selectApartment(item) {
      this.apartment_type = item;
    },
    selectTotalArea(item) {
      this.total_area = item;
    },
    selectPrice(item) {
      this.price = item;
    },
    submitSearch() {
      this.$router.push({
        path: `${
          this.$i18n.locale === "ar" ? "" : "/" + this.$i18n.locale
        }/properties/istanbul${window.location.search}`
      });
    },
    activate: function(el) {
      if (this.active_el === el) this.active_el = null;
      else this.active_el = el;
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  },

  head() {
    return {
      title: this.blog.title + " - " + this.$t("app.name"),
      meta: this.meta
    };
  },
  components: {
    Subscribe,
    SocialSharing,
    AisInstantSearchSsr,
    AisRefinementList,
    AisNumericMenu,
    createInstantSearch,
    truncate,
    ConvertPrice,
    ContactUs
  },
  async asyncData({ store, error, params }) {
    const data = {
      lang: store.app.i18n._vm.locale,
      slug: params.slug
    };
    let [res] = await Promise.all([
      store.dispatch("getBlog", data),
      store.dispatch("getFeatured", store.app.i18n._vm.locale),
      store.dispatch("getCurrentPage", "article_details"),
      store.dispatch("getApartment", store.app.i18n._vm.locale)
    ]);
    const $apartment_type = "apartment_type.name." + store.app.i18n.locale;
    const $rooms = "meta.rooms." + store.app.i18n.locale;
    const $price = "meta.price." + store.app.i18n.locale;
    const $area = "meta.area." + store.app.i18n.locale;
    return instantsearch
      .findResultsState({
        query: "",
        hitsPerPage: 15,
        disjunctiveFacets: [$apartment_type, $rooms, $price, $area]
      })
      .then(() => ({
        algoliaState: instantsearch.getState()
      }));
  },
  computed: {
    blog() {
      return this.$store.state.blog;
    },
    featured() {
      return _.slice(this.$store.state.featured, 0, this.featuredCount);
    },
    totalFeaturedCount() {
      return this.$store.state.featured.length;
    },
    projects() {
      return _.slice(this.$store.state.projects, 0, 5);
    },
    apartment() {
      return this.$store.state.apartment;
    },
    symbol() {
      return this.$store.state.symbol;
    },
    meta() {
      return this.blog.seo;
    },
    siteURL() {
      return this.$store.state.siteURL;
    },
    settings() {
      return this.$store.state.settings;
    }
  },
  methods: {
    validateBeforeSubmit(event) {
      this.$validator.resume();
      this.$validator.validate().then(result => {
        if (result) {
          //// eslint-disable-next-line
          axios
            .post("/api/call", {
              code: this.call.code,
              mobile: this.call.mobile,
              name: this.call.name,
              email: this.call.email,
              page: this.call.page
            })
            .then(res => {
              this.success = true;
              const $this = this;
              setTimeout(function() {
                $this.call = {
                  mobile: null,
                  email: null
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
    },
    onSelect({ name, iso2, dialCode }) {
      this.call.code = dialCode;
    },

    loadMoreFeatures() {
      this.featuredCount = this.featuredCount + 3;
      if (this.featuredCount > this.totalFeaturedCount) {
        this.featuredCount = this.totalFeaturedCount;
      }
    }
  },
  mounted() {
    // window.main.init();
  }
};
</script>
<style lang="scss" scoped>
.offer-title {
  h3 {
    font-size: 16px;
    height: 44px;
    overflow: hidden;
    @include respond-to(991px) {
      width: 100%;
    }
  }
}
</style>

<style lang="scss">
.blog-img {
  height: 550px;
  object-fit: cover;
  @include respond-to(576px) {
    height: 250px;
  }
}

.table-content {
  margin-top: 20px;

  .menu_level_1 {
    padding: 0;
  }

  .first.last {
    &:before {
      display: none;
    }
  }

  a {
    display: block;
    margin-bottom: 15px;
    color: #3489d8;
    text-decoration: none;

    &:hover {
      text-decoration: underline;
    }
  }
}

.blog-details-page {
  background-color: #f7f7f7;

  @include respond-to(576px) {
    h3 {
      font-size: 16px !important;
    }
  }

  .left-side {
    width: 66.66667%;
  }

  .right-side {
    width: 33.33333%;
  }

  .left-side,
  .right-side {
    @include respond-to(991px) {
      width: 100%;
    }
  }

  .publish-time {
    border-bottom: 1px solid #f7f7f7;
  }

  .article-footer {
    border-top: 1px solid #f7f7f7;
  }

  .blog-details-tags {
    border-top: 1px solid #f7f7f7;

    .tag {
      background-color: #f2f2f2;
      display: inline-block;
      @include respond-to(1100px) {
        margin-bottom: 10px;
      }
    }
  }

  .blog-share {
    .item {
      width: 26px;
      height: 26px;
      text-align: center;
      line-height: 26px;

      a {
        display: block;
      }
    }
  }

  .subscribe {
    margin-top: 0;
  }

  .search-box {
    border-color: #f2f2f2;
  }

  .aside-img {
    img {
      object-fit: cover;
    }
  }

  .features-side {
    > img {
      @include respond-to-min-width(1600px) {
        height: 200px;
      }
      @include respond-to(1600px) {
        height: 150px;
      }
      object-fit: cover;
    }

    html[dir="ltr"] .offer-info .beds,
    .offer-info .house {
      border-right: 1px solid #f0f0f0;
    }

    html[dir="rtl"] .offer-info .beds,
    .offer-info .house {
      border-left: 1px solid #f0f0f0;
    }
  }
}
</style>
<style lang="scss">
.editor-text {
  h1 {
    color: #401a66;
    font-weight: bold;
    margin: 1.25em 0;
    font-size: 1.5rem;
  }
  h2 {
    color: #661a40;
    font-weight: bold;
    margin: 1.25em 0;
    font-size: 1.5rem;
  }
  h3 {
    color: #1a4066;
    font-weight: bold;
    margin: 1.25em 0;
    font-size: 1.125rem;
  }

  p {
    font-size: 1rem;
    color: #333;
    margin: 1.5rem 0;
    line-height: 1.5;
  }

  ul {
    list-style: none;

    li {
      position: relative;
      margin-bottom: 15px;

      &:before {
        content: "";
        position: absolute;
        top: 5px;
        width: 10px;
        height: 10px;
        @include border-radius(50%);
        background: #3489d8;
      }
    }
  }
}

html[dir="ltr"] .editor-text ul li:before {
  left: -20px;
}

html[dir="rtl"] .editor-text ul li:before {
  right: -20px;
}

.blog-details-page {
  .subscribe-width {
    width: 80% !important;
    @include respond-to(991px) {
      width: 100% !important;
    }
  }

  .subscribe-box {
    @include respond-to(991px) {
      h3 {
        font-size: 20px !important;
      }
      padding-right: 5px;
      padding-left: 5px;
      margin-bottom: 20px;
    }
    box-shadow: none;
  }

  .v-select {
    width: 60%;
  }
}
</style>
