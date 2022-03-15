<template>
  <div class="container-content absolute pin-b pin-x">
    <form novalidate @submit.prevent="submitSearch">
      <no-ssr>
        <ais-instant-search-ssr>
          <div class="search-title flex items-center text-center justify-center">
            <a
              class="font-sm text-blue-shadow  no-underline py-3 px-8 xs:px-2 xs:text-xs bg-white ltr:rounded-tl-lg rtl:rounded-tr-lg cursor-pointer"
              @click.prevent="selectTab(0)" :class="selectedTab===0?'active':''">Advanced Search</a>
            <a
              class="font-sm text-blue-shadow  no-underline py-3 px-8 xs:px-2 xs:text-xs bg-white ltr:rounded-tr-lg rtl:rounded-tl-lg cursor-pointer"
              @click.prevent="selectTab(1)" :class="selectedTab===1?'active':''">Free Text Search</a>
          </div>
          <div
            class="bg-white w-4/5 mx-auto search-box flex md:flex-wrap xs:w-full md:w-3/4 items-center justify-between">
            <div class="w-full" :class="selectedTab===0?'':'hidden'">
              <div class="filter-search drops px-8 items-center justify-between flex flex-wrap w-full md:p-2">
                <div class="w-1/4 md:w-1/2 px-4 md:px-2 md-lg:mb-4">
                  <ais-refinement-list
                    attribute="apartment_type.name.en"
                  >
                    <div
                      slot-scope="{
      items,
      isFromSearch,
      refine,
      createURL,
    }"
                    >
                      <ul>
                        <li v-for="item in items" :key="item.value">
                          <a
                            :href="createURL(item)"
                            :style="{ fontWeight: item.isRefined ?  'bold' : '' }"
                            @click.prevent="refine(item.value)"
                          >
                            <ais-highlight attribute="item" :hit="item"/>
                            ({{ item.count.toLocaleString() }})
                          </a>
                        </li>
                      </ul>
                    </div>
                  </ais-refinement-list>
                  <!--              <v-select label="Looking For" :options="options" :placeholder="'Looking For'"></v-select>-->
                </div>
                <div class="w-1/4 md:w-1/2 px-4 md:px-2 md-lg:mb-4">
<!--                  <ais-numeric-menu-->
<!--                    attribute="bedrooms"-->
<!--                    :items="[-->
<!--                        {label: 'All'},-->
<!--                        {label: 'Studio [استوديو]', end: 0},-->
<!--                        {label: 'غرفة وصالة', end: 1, start: 1},-->
<!--                        {label: 'غرفتين وصالة', end: 2, start: 2},-->
<!--                        {label: '3 غرف وصالة', end: 3, start: 3},-->
<!--                        {label: '4 غرف وصالة', end: 4, start: 4},-->
<!--                        {label: 'اعلى من 4 غرف وصالة', start: 5},-->
<!--                    ]"-->
<!--                  >-->
<!--                    <ul slot-scope="{ items, refine, createURL }">-->
<!--                      <li v-for="item in items" :key="item.value">-->
<!--                        <a-->
<!--                          :href="createURL(item.value)"-->
<!--                          :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
<!--                          @click.prevent="refine(item.value)"-->
<!--                        >-->
<!--                          {{ item.label }}-->
<!--                        </a>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                  </ais-numeric-menu>-->
                  <ais-refinement-list
                    :attribute="rooms"
                  />
                </div>
                <div class="w-1/4 md:w-1/2 px-4 md:px-2 md-lg:mb-4">
<!--                  <ais-numeric-menu-->
<!--                    attribute="price"-->
<!--                    :items="[-->
<!--                        {label: 'less than 500000', end: 50000},-->
<!--                        {label: 'between 500000 and 1000000', end: 1000000, start: 500000},-->
<!--                        {label: 'between 1000000 and 1500000', end: 1500000, start: 1000000},-->
<!--                        {label: 'between 1500000 and 2000000', end: 2000000, start: 1500000},-->
<!--                        {label: 'between 2000000 and 2500000', end: 2500000, start: 2000000},-->
<!--                        {label: 'between 2500000 and 3000000', end: 3000000, start: 2500000},-->
<!--                        {label: 'more than 3000000', start: 3000000},-->
<!--                    ]"-->
<!--                  >-->
<!--                    <ul slot-scope="{ items, refine, createURL }">-->
<!--                      <li v-for="item in items" :key="item.value">-->
<!--                        <a-->
<!--                          :href="createURL(item.value)"-->
<!--                          :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
<!--                          @click.prevent="refine(item.value)"-->
<!--                        >-->
<!--                          {{ item.label }}-->
<!--                        </a>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                  </ais-numeric-menu>-->
                  <ais-refinement-list
                    :attribute="price"
                  />
                </div>
                <div class="w-1/4 md:w-1/2 px-4 md:px-2 md-lg:mb-4">
<!--                  <ais-numeric-menu-->
<!--                    attribute="total_area"-->
<!--                    :items="[-->
<!--                        {label: 'All'},-->
<!--                        {label: 'less than 50 m2', end: 50},-->
<!--                        {label: 'between 50 m2 and 100 m2', end: 100, start: 50},-->
<!--                        {label: 'between 100 m2 and 150 m2', end: 150, start: 100},-->
<!--                        {label: 'between 150 m2 and 200 m2', end: 200, start: 150},-->
<!--                        {label: 'between 200 m2 and 250 m2', end: 250, start: 200},-->
<!--                        {label: 'more than 250 m2', start: 250},-->
<!--                    ]"-->
<!--                  >-->
<!--                    <ul slot-scope="{ items, refine, createURL }">-->
<!--                      <li v-for="item in items" :key="item.value">-->
<!--                        <a-->
<!--                          :href="createURL(item.value)"-->
<!--                          :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
<!--                          @click.prevent="refine(item.value)"-->
<!--                        >-->
<!--                          {{ item.label }}-->
<!--                        </a>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                  </ais-numeric-menu>-->
                  <ais-refinement-list
                    :attribute="area"
                  />
                </div>
              </div>
            </div>
            <div class="w-full h-full" :class="selectedTab===1?'':'hidden'">
              <div class="filter-search px-8 flex items-center justify-between flex-wrap w-full md:p-2 h-full">
                <input class="w-full h-full text-xl" type="text" placeholder="Type Here...">
              </div>

            </div>
            <div class="bg-dark-blue flex h-full search-icon md:w-full">
              <button type="submit"
                      class="flex items-center justify-center text-white text-2xl no-underline px-12 md:px-4"><i
                class="fas fa-search"></i></button>
            </div>
          </div>
        </ais-instant-search-ssr>
      </no-ssr>
    </form>
  </div>
</template>
<script>
  import 'vue-select/dist/vue-select.css';
  import {
    AisInstantSearchSsr,
    AisRefinementList,
    AisNumericMenu,
    // for some reason eslint doesn't recognise this dependency, while it's in package.json
    // eslint-disable-next-line import/no-unresolved
  } from 'vue-instantsearch';
  import algoliasearch from 'algoliasearch/lite';

  export default {
    components: {
      AisInstantSearchSsr,
      AisRefinementList,
      AisNumericMenu,
    },
    data() {
      return {
        options: [
          'foo',
          'bar',
          'baz'
        ],
        selectedTab: 0,
        price: 'meta.price.' + this.$store.app.i18n.locale,
        rooms: 'meta.rooms.' + this.$store.app.i18n.locale,
        area: 'meta.area.' + this.$store.app.i18n.locale,
      }
    },
    methods: {
      selectTab(index) {
        this.selectedTab = index;
      },
      getUrlVars() {
        let vars = [], hash;
        const hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (let i = 0; i < hashes.length; i++) {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
        }
        return vars;
      },
      submitSearch() {
        this.$router.push({
          path: `/real-estate${window.location.search}`
        })
      },
    },
    mounted() {
      console.log(this.$route.query);
    }
  }
</script>
<style lang="scss" scoped>
  .container-content {
    bottom: 10%;

  }

  .search-box {
    height: 120px;
    border-radius: 15px;
    box-shadow: 0 30px 25px 0 rgba(0, 0, 0, 0.2);
    @include respond-to(991px) {
      height: auto;
    }
  }

  .filter-search {
    @include respond-to-min-max-width(767px, 991px) {
      padding: 30px 0;
    }
  }

  html[dir='ltr'] .search-icon {
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
    @include respond-to(991px) {
      border-top-right-radius: 0;
      border-bottom-right-radius: 15px;
      border-bottom-left-radius: 15px;
    }
  }

  html[dir='rtl'] .search-icon {
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    @include respond-to(991px) {
      border-top-left-radius: 0;
      border-bottom-left-radius: 15px;
      border-bottom-right-radius: 15px;
    }
  }

  .search-icon {

    @include respond-to(991px) {
      display: block;
      a {
        padding: 10px 0;

      }
    }
  }

  .search-title {
    a {
      box-shadow: inset 0 0 15px -5px rgba(0, 0, 0, 0.3);

      &:hover {
        color: #3489d8;;
      }
    }

    .active {
      box-shadow: none;
      color: #3489d8;
    }
  }

  input {
    &:focus {
      outline: none;
    }
  }
</style>


