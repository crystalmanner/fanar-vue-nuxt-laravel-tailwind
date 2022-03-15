<template>
  <div class="padding-menu">
    <ais-instant-search-ssr>
      <div class="real-estate-page">
        <div class="real-hero relative">
          <img class="w-full" src="/img/real-estats.png" alt />
          <div class="hero-content flex justify-center items-center absolute pin-x pin-y">
            <div class="container-content text-center">
              <h1
                class="text-3xl text-white text-center mb-4 uppercase font-bold sm:text-xl"
              >{{$t('real_estate.title')}}</h1>
              <p class="text-white text-xl sm:text-sm">{{$t('real_estate.subtitle')}}</p>
              <ais-search-box :placeholder="$t('home.search')" />
            </div>
          </div>
        </div>
        <no-ssr>
          <div class="container-content">
            <div class="real-filter">
              <div class="w-full flaters" v-show="isOpen" :class="{ showit: !isOpen }">
                <div class="filter-title flex items-center justify-between text-white">
                  <h3>{{$t('real_estate.filters')}}</h3>
                  <i class="fas fa-times cursor-pointer" @click.self="toggle()"></i>
                </div>
                <ul class="list-reset flex items-center justify-between responsive-list">
                  <li class="text-main-color text-sm font-bold py-4 relative price-list">
                    <div>
                      <span class="cursor-pointer">{{$t('home.price')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <div>
                      <!--                      <ais-numeric-menu attribute="price"-->
                      <!--                                        :items="[-->
                      <!--                              {label: $t('home.less_than')+' '+this.getPrice(formatPrice('50000')), end: 50000},-->
                      <!--                              {label: $t('home.between')+' '+this.getPrice(formatPrice('500000'))+' '+ $t('home.and') +' '+this.getPrice(formatPrice('1000000')), end: 1000000, start: 500000},-->
                      <!--                              {label: $t('home.between')+' '+this.getPrice(formatPrice('1000000'))+' '+ $t('home.and') +' '+this.getPrice(formatPrice('1500000')), end: 1500000, start: 1000000},-->
                      <!--                              {label: $t('home.between')+' '+this.getPrice(formatPrice('1500000'))+' '+ $t('home.and') +' '+this.getPrice(formatPrice('2000000')), end: 2000000, start: 1500000},-->
                      <!--                              {label: $t('home.between')+' '+this.getPrice(formatPrice('2000000'))+' '+ $t('home.and') +' '+this.getPrice(formatPrice('2500000')), end: 2500000, start: 2000000},-->
                      <!--                              {label: $t('home.between')+' '+this.getPrice(formatPrice('2500000'))+' '+ $t('home.and') +' '+this.getPrice(formatPrice('3000000')), end: 3000000, start: 2500000},-->
                      <!--                              {label: $t('home.more_than')+' '+this.getPrice(formatPrice('3000000')), start: 3000000},-->
                      <!--                          ]"-->
                      <!--                      />-->
                      <ais-refinement-list :attribute="price" />
                    </div>
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.municipality')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="municipality" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.bedrooms')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <!--                    <ais-numeric-menu-->
                    <!--                      attribute="bedrooms"-->
                    <!--                      :items="[-->
                    <!--                              {label: $t('home.all') },-->
                    <!--                              {label: $t('home.studio'), end: 0},-->
                    <!--                              {label: $t('home.lounge_&_room'), end: 1, start: 1},-->
                    <!--                              {label: $t('home.lounge_&_2rooms'), end: 2, start: 2},-->
                    <!--                              {label: $t('home.lounge_&_3rooms'), end: 3, start: 3},-->
                    <!--                              {label: $t('home.lounge_&_4rooms'), end: 4, start: 4},-->
                    <!--                              {label: $t('home.lounge_&_more_than_4rooms'), start: 5},-->
                    <!--                          ]"-->
                    <!--                    />-->
                    <ais-refinement-list :attribute="rooms" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.apartment_type')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="apartment_type" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.total_area')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <!--                    <ais-numeric-menu-->
                    <!--                      attribute="total_area"-->
                    <!--                      :items="[-->
                    <!--                              {label: $t('home.all')},-->
                    <!--                              {label: $t('home.less_than')+' 50 '+$t('home.m2'), end: 50},-->
                    <!--                              {label: $t('home.between')+' 50 '+ $t('home.m2') +' '+$t('home.and')+' 100 '+ $t('home.m2'), end: 100, start: 50},-->
                    <!--                              {label: $t('home.between')+' 100 '+ $t('home.m2') +' '+$t('home.and')+' 150 '+ $t('home.m2'), end: 150, start: 100},-->
                    <!--                              {label: $t('home.between')+' 150 '+ $t('home.m2') +' '+$t('home.and')+' 200 '+ $t('home.m2'), end: 200, start: 150},-->
                    <!--                              {label: $t('home.between')+' 200 '+ $t('home.m2') +' '+$t('home.and')+' 250 '+ $t('home.m2'), end: 250, start: 200},-->
                    <!--                              {label: $t('home.more_than')+' 250 '+ $t('home.m2'), start: 250},-->
                    <!--                          ]"-->
                    <!--                    />-->
                    <ais-refinement-list :attribute="area" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.payment_type')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="payment_type" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.investment_return')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="investment_return" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative">
                    <div>
                      <span class="cursor-pointer">{{$t('home.views')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="views" />
                  </li>
                  <li class="text-main-color text-sm font-bold py-4 relative up-time">
                    <div>
                      <span class="cursor-pointer">{{$t('home.uptime')}}</span>
                      <i class="fas fa-chevron-down ltr:pl-2 rtl:pr-2"></i>
                    </div>
                    <ais-refinement-list :attribute="project_status" />
                  </li>
                </ul>
              </div>
              <button class="filter-btn" @click="toggle()">
                <i class="fas fa-filter"></i>
                <span class="text-main-color font-bold text-base">{{$t('real_estate.filters')}}</span>
              </button>
            </div>
          </div>
        </no-ssr>

        <div class="estate-content">
          <div class="container-content py-6">
            <div class="list-filter flex items-center">
              <ais-stats>
                <div class="text-xs text-blue-shadow" slot-scope="{ nbHits }">
                  <span v-if="nbHits > 0">{{nbHits + ' ' + $t('real_estate.single')}}</span>
                  <p v-else class="text-2xl mt-5">
                    <span>{{$t('real_estate.no_matching_results')}}</span>
                    <a
                      @click.prevent="goTo(localePath('properties')+'/istanbul')"
                      class="cursor-pointer text-main-color no-underline hover:text-dark-blue"
                    >{{ $t('app.back') }}</a>
                  </p>
                </div>
              </ais-stats>

              <ais-current-refinements class="flex-grow">
                <ul class="list-reset ltr:pl-2 rtl:pr-2 -mt-4" slot-scope="{ items, createURL }">
                  <li
                    class="ltr:ml-4 rtl:mr-4 mt-4 inline-block"
                    v-for="item in items"
                    :key="item.attribute"
                  >
                    <ul class="list-reset list-refinements">
                      <li
                        v-for="refinement in item.refinements"
                        :key="[
                          refinement.attribute,
                          refinement.type,
                          refinement.value,
                          refinement.operator
                        ].join(':')"
                      >
                        <a
                          class="block border border-1 border-grey text-sm p p-2 rounded-lg text-blue no-underline"
                          :href="createURL(refinement)"
                          @click.prevent="item.refine(refinement)"
                        >
                          {{ getLabel(item) }}
                          <i class="fa fa-times"></i>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </ais-current-refinements>
            </div>

            <div class="estates-result flex flex-wrap pt-5 -mx-4">
              <ais-infinite-hits>
                <template slot="item" slot-scope="{ item }">
                  <div class="px-4 mb-12">
                    <n-link
                      :to="localePath('properties')+'/istanbul/'+item.slug"
                      class="no-underline text-main-color"
                    >
                      <div
                        class="max-w-sm rounded-lg shadow-lg"
                        itemscope
                        itemtype="http://schema.org/Product"
                      >
                        <link itemprop="url" :href="link" />
                        <div class="relative">
                          <img
                            class="w-full rounded-tr-lg rounded-tl-lg custom-img"
                            :src="item.image"
                            alt="Product Image"
                            itemprop="image"
                          />
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
                              <i class="fas fa-map-marker-alt text-brown-color"></i>
                              <span v-if="testName==='name.en'">
                                <span
                                  v-if="item.municipality.city"
                                >{{item.municipality.city.name.en}}</span> -
                                <span v-if="item.municipality.name">{{item.municipality.name.en}}</span>
                              </span>
                              <span v-else-if="testName==='name.ar'">
                                <span
                                  v-if="item.municipality.city"
                                >{{item.municipality.city.name.ar}}</span> -
                                <span v-if="item.municipality.name">{{item.municipality.name.ar}}</span>
                              </span>
                            </p>
                          </div>
                          <div class="offer-title flex flex-wrap">
                            <h3 class="text-lg font-bold mb-2">
                              <n-link
                                :to="'istanbul'+'/'+item.slug"
                                class="no-underline text-main-color"
                                v-if="testName==='name.en'"
                              >
                                <truncate
                                  :length="75"
                                  clamp
                                  less
                                  type="html"
                                  :text="'<p>'+item.name.en+'</p>'"
                                  itemprop="name"
                                ></truncate>
                              </n-link>
                              <n-link
                                :to="'istanbul'+'/'+item.slug"
                                class="no-underline text-main-color"
                                v-else-if="testName==='name.ar'"
                              >
                                <truncate
                                  :length="75"
                                  clamp
                                  less
                                  type="html"
                                  :text="'<p>'+item.name.ar+'</p>'"
                                  itemprop="name"
                                ></truncate>
                              </n-link>
                            </h3>
                          </div>
                          <!-- offer-title -->
                          <div
                            class="offer-info flex items-center content-center border-solid border rounded"
                          >
                            <div class="beds w-1/3 py-1">
                              <div class="text-center">
                                <img
                                  src="/img/bed.svg"
                                  class="text-dark-blue bed-icon mb-1"
                                  alt="bed icon"
                                />
                                <p class="text-main-color text-xs font-bold">
                                  <span class="ltr:pr-1 rtl:pl-1">{{item.bedrooms}}</span>
                                  {{$t('home.bedrooms')}}
                                </p>
                              </div>
                            </div>
                            <div class="house w-1/3 py-1">
                              <div class="text-center">
                                <img src="/img/home.svg" class="mb-1 home-icon" alt="home icon" />
                                <p class="text-main-color text-xs font-bold">
                                  <span class="ltr:pr-1 rtl:pl-1">{{item.total_area}}</span>
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
                                  <span class="ltr:pr-1 rtl:pl-1">{{item.bathrooms}}</span>
                                  {{$t('home.bathrooms')}}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </n-link>
                  </div>
                </template>
                <!-- <div class="text-center"> -->
                <button
                  class="bg-dark-blue text-white rounded-full py-2 px-4 text-base"
                  slot="loadMore"
                  slot-scope="{ page, isLastPage, refineNext }"
                  :disabled="isLastPage"
                  @click="refineNext"
                >{{$t('real_estate.load_more')}}</button>
                <!-- </div> -->
              </ais-infinite-hits>
            </div>
          </div>
        </div>
        <ContactUs />
      </div>
    </ais-instant-search-ssr>
  </div>
</template>

<script>
import "vue-select/dist/vue-select.css";
import ContactUs from "~/components/contact-us";
import truncate from "vue-truncate-collapsed";
import {
  AisInstantSearchSsr,
  AisRefinementList,
  AisCurrentRefinements,
  AisHits,
  AisHighlight,
  AisSearchBox,
  AisStats,
  AisPagination,
  AisNumericMenu,
  createInstantSearch
  // for some reason eslint doesn't recognise this dependency, while it's in package.json
  // eslint-disable-next-line import/no-unresolved
} from "vue-instantsearch";
import algoliasearch from "algoliasearch/lite";
import { history as historyRouter } from "instantsearch.js/es/lib/routers";
import { simple as simpleMapping } from "instantsearch.js/es/lib/stateMappings";
import ConvertPrice from "~/components/ConvertPrice";

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
  head() {
    return {
      title: this.$t("app.name") + " - " + this.title,
      meta: this.page.seo
    };
  },
  data() {
    return {
      options: ["Male", "Female"],
      active_el: null,
      isOpen: false,
      municipality: "municipality.name." + this.$store.app.i18n.locale,
      apartment_type: "apartment_type.name." + this.$store.app.i18n.locale,
      payment_type: "payment_type.name." + this.$store.app.i18n.locale,
      investment_return:
        "investment_return.name." + this.$store.app.i18n.locale,
      views: "views.name." + this.$store.app.i18n.locale,
      project_status: "project.status.name." + this.$store.app.i18n.locale,
      price: "meta.price." + this.$store.app.i18n.locale,
      rooms: "meta.rooms." + this.$store.app.i18n.locale,
      area: "meta.area." + this.$store.app.i18n.locale,
      testName: "name." + this.$store.app.i18n.locale,
      itemsCount: 0
    };
  },
  computed: {
    page() {
      return this.$store.state.page;
    },
    symbol() {
      return this.$store.state.symbol;
    },
    title() {
      return this.page ? this.page.title : this.$t("links.real-estate");
      // const item = this.page.seo.find((x => {
      //   return x.name === 'title'
      // }));
      // return item ? item.content : this.$t('links.real-estate');
    },
    link() {
      const item = this.page.seo.find(x => {
        return x.name === "url";
      });
      return item ? item.content : "";
    }
  },
  methods: {
    goTo(link) {
      location.replace(link);
    },
    getPrice(price) {
      if (this.$store.state.currency === "try") return price;
      else
        return parseFloat(
          (price / this.$store.state.currentRate).toString()
        ).toFixed(2);
    },
    activate(el) {
      if (this.active_el === el) this.active_el = null;
      else this.active_el = el;
    },
    toggle() {
      this.isOpen = !this.isOpen;
    },
    getLabel(item) {
      if (item.attribute === "price" || item.attribute === "total_area") {
        if (item.refinements.length === 1) {
          if (item.refinements[0].operator === "<=") {
            return (
              this.$t("home.less_than") +
              " " +
              this.getPrice(item.refinements[0].value)
            );
          } else if (item.refinements[0].operator === ">=") {
            return (
              this.$t("home.more_than") +
              " " +
              this.getPrice(item.refinements[0].value)
            );
          }
        } else {
          return (
            this.$t("home.between") +
            " " +
            this.getPrice(item.refinements[0].value) +
            " " +
            this.$t("home.and") +
            " " +
            this.getPrice(item.refinements[1].value)
          );
        }
      } else {
        return item.refinements[0].label;
      }
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  },
  async asyncData({ store, query }) {
    let res = await Promise.all([
      store.dispatch("getCurrentPage", "real_estae_list"),
      store.dispatch("getPage", {
        lang: store.app.i18n._vm.locale,
        page: "properties"
      }) //real-estate
    ]);
    const $municipality = "municipality.name." + store.app.i18n.locale;
    const $apartment_type = "apartment_type.name." + store.app.i18n.locale;
    const $payment_type = "payment_type.name." + store.app.i18n.locale;
    const $investment_return =
      "investment_return.name." + store.app.i18n.locale;
    const $views = "views.name." + store.app.i18n.locale;
    const $project_status = "project.status.name." + store.app.i18n.locale;
    const $price = "meta.price." + store.app.i18n.locale;
    const $rooms = "meta.rooms." + store.app.i18n.locale;
    const $area = "meta.area." + store.app.i18n.locale;
    const $testName = "name." + store.app.i18n.locale;

    return instantsearch
      .findResultsState({
        query: "",
        hitsPerPage: 15,
        disjunctiveFacets: [
          $municipality,
          $apartment_type,
          $payment_type,
          $investment_return,
          $views,
          $project_status,
          $price,
          $rooms,
          $area
        ]
      })
      .then(() => ({
        algoliaState: instantsearch.getState()
      }));
  },
  mounted() {
    // window.main.init();
  },
  beforeMount() {
    // Nuxt will merge `asyncData` and `data` on the client
    instantsearch.hydrate(this.algoliaState);
  },
  mixins: [rootMixin],
  components: {
    AisInstantSearchSsr,
    AisRefinementList,
    AisCurrentRefinements,
    AisHits,
    AisHighlight,
    AisSearchBox,
    AisStats,
    AisPagination,
    AisNumericMenu,
    ContactUs,
    ConvertPrice,
    truncate
  }
};
</script>
<style lang="scss" scoped>
.card-body {
  overflow: hidden;
  @include respond-to(991px) {
    h3 {
      font-size: 16px !important;
    }
  }
}

.offer-title h3 {
  height: 44px;
  overflow: hidden;
  font-size: 16px;
}

.real-hero {
  position: relative;
  z-index: 8;
}

.list-refinements {
  > li {
    &:not(:first-child) {
      display: none;
    }
  }
}
</style>
<style lang="scss">
.ais-InfiniteHits {
  width: 100%;
  display: flex;
  flex-direction: column;
  button {
    align-self: center;
    width: max-content;
  }
}

.ais-SearchBox {
  position: relative;
  display: flex;
  align-items: center;
  margin: 0 auto;
  margin-top: 20px;
  width: 50%;
  @include respond-to(1280px) {
    width: 100%;
  }

  .ais-SearchBox-submit,
  .ais-SearchBox-reset {
    position: absolute;
  }

  .ais-SearchBox-reset {
    display: none;
  }

  .ais-SearchBox-submit {
    top: 25%;
    left: 20px;

    svg {
      width: 16px;
      height: 16px;
      fill: #3489d8;
    }
  }

  form {
    width: 100%;
  }

  input {
    height: 100%;
    width: 100%;
    padding: 0.75rem;
    background: #fff;
    font-size: 0.875rem;
    flex-grow: 1;
    color: #5b8da6;
    border-radius: 9999px;
    padding-left: 50px;

    &:focus {
      box-shadow: none;
      outline: none;
    }
  }
}

.ais-InfiniteHits-list {
  display: flex;
  flex-wrap: wrap;

  .ais-InfiniteHits-item {
    width: 33.33333%;
    @include respond-to-min-width(1610px) {
      width: 25%;
    }
    @include respond-to(991px) {
      width: 50%;
    }
    @include respond-to(576px) {
      width: 100%;
    }

    .custom-img {
      height: 280px;
      object-fit: cover;
      @include respond-to(576px) {
        height: 220px;
      }
    }
  }
}

.showit {
  @include respond-to-min-width(1100px) {
    display: block !important;
  }
}

.estate-content {
  background-color: #f7f7f7;
}

.real-hero {
  img {
    height: 250px;
    object-fit: cover;
  }
}

.estate-content {
  > img {
    @include respond-to-min-width(1600px) {
      height: 300px;
    }
    height: 220px;
    object-fit: cover;
    @include respond-to(576px) {
      height: 180px;
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
}

//new
.ais-InfiniteHits-list {
  list-style-type: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
}

/* Custom Algolia */

.ais-NumericMenu-list,
.ais-RefinementList-list {
  list-style: none;
  position: absolute;
  left: 0;
  width: 270px;
  min-width: 200px;
  top: -300px;
  background: #fff;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  z-index: 7;
  overflow: hidden;
  padding-left: 15px;

  li {
    margin-bottom: 10px;
    color: #1a4066;
    cursor: pointer;

    &:hover {
      background-color: #f9f9f9;
    }
  }
}

.real-filter {
  li {
    &:hover {
      .ais-NumericMenu-list,
      .ais-RefinementList-list {
        top: 48px;
      }
    }
  }
}

input[type="radio"] {
  width: 15px;
  height: 15px;
  border: none;
  box-shadow: none;
  appearance: none;

  &:before {
    content: "";
    background: #dfdfdf;
    border-radius: 100%;
    display: inline-block;
    width: 15px;
    height: 15px;
    vertical-align: baseline;
    cursor: pointer;
    text-align: center;
    transition: all 250ms ease;
  }

  &:checked {
    &:before {
      background-color: #3489d8;
    }
  }

  &:focus {
    outline: none;

    &:before {
      outline: none;
      border-color: #3489d8;
    }
  }

  &:disabled {
    &:before {
      box-shadow: inset 0 0 0 4px #f4f4f4;
      border-color: darken(#f4f4f4, 25%);
      background: darken(#f4f4f4, 25%);
    }
  }

  /*+ .radio-label {*/
  /*  &:empty {*/
  /*    &:before {*/
  /*      margin-right: 0;*/
  /*    }*/
  /*  }*/
  /*}*/
}

input[type="checkbox"] {
  width: 20px;
  height: 20px;
  border: none;
  box-shadow: none;
  appearance: none;
  position: relative;

  &:before {
    content: "";
    background: #dfdfdf;
    display: inline-block;
    width: 20px;
    height: 20px;
    vertical-align: bottom;
    cursor: pointer;
    text-align: center;
    transition: all 250ms ease;
  }

  &:checked {
    &:after {
      content: "";
      display: block;
      position: absolute;
      top: 2px;
      left: 6px;
      width: 6px;
      height: 14px;
      border: solid #0079bf;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }
  }

  &:focus {
    outline: none;

    &:before {
      outline: none;
      border-color: #3489d8;
    }
  }

  &:disabled {
    &:before {
      box-shadow: inset 0 0 0 4px #f4f4f4;
      border-color: darken(#f4f4f4, 25%);
      background: darken(#f4f4f4, 25%);
    }
  }
}

.filter-title {
  display: none;
}

.filter-btn {
  display: none;
  @include respond-to(1100px) {
    display: inline-block;
    box-shadow: 0 1px 6px rgba(57, 73, 76, 0.35);
    padding: 10px 5px;
    @include transition_default();
    &:hover {
      box-shadow: 0 2px 10px 1px rgba(57, 73, 76, 0.4),
        0 1px 2px rgba(57, 73, 76, 0.25);
    }
  }
}

.real-filter {
  .ais-RefinementList-count {
    top: 0;
  }

  @include respond-to(100px) {
    padding: 10px 30px;
  }

  .flaters {
    @include respond-to(1100px) {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 91;
      background: #fff;
      overflow: hidden;
      .filter-title {
        display: flex;
        border-bottom: 1px solid #e0e0e0;
        background: #f9f9f9;
        padding: 15px 20px 15px 30px;
        margin-bottom: 20px;

        h3,
        i {
          font-size: 22px;
          color: #222;
        }
      }
      li {
        i {
          display: none;
        }
      }
      ul {
        padding: 0;
      }
      .responsive-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: unset;
        padding: 0 30px;
      }
      .ais-NumericMenu-list,
      .ais-RefinementList-list {
        position: static;
        padding-top: 20px;
        overflow: unset;
        max-height: 100%;
        margin-bottom: 20px;
      }
    }
  }
}

html[dir="ltr"] .real-filter {
  li {
    &.price-list {
      &:hover {
        .ais-RefinementList-list {
          left: 0;
        }
      }
    }

    &.up-time {
      &:hover {
        .ais-RefinementList-list {
          right: 0;
          left: auto;
        }
      }
    }
  }
}

html[dir="rtl"] .real-filter {
  li {
    &.price-list {
      &:hover {
        .ais-RefinementList-list {
          right: 0;
        }
      }
    }

    &.up-time {
      &:hover {
        .ais-RefinementList-list {
          left: 0;
        }
      }
    }
  }
}
</style>
