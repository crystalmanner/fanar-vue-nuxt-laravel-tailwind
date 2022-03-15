<template>
  <div class="container-content absolute pin-b pin-x">
    <form novalidate @submit.prevent="submitSearch">
      <no-ssr>
        <ais-instant-search-ssr>
          <div class="search-title flex items-center text-center justify-center">
            <a
              class="font-sm text-blue-shadow  no-underline py-3 px-8 xs:px-2 xs:text-xs bg-white ltr:rounded-tl-lg rtl:rounded-tr-lg cursor-pointer"
              @click.prevent="selectTab(0)" :class="selectedTab===0?'active':''">{{$t('home.advanced_search')}}</a>
            <a
              class="font-sm text-blue-shadow  no-underline py-3 px-8 xs:px-2 xs:text-xs bg-white ltr:rounded-tr-lg rtl:rounded-tl-lg cursor-pointer"
              @click.prevent="selectTab(1)" :class="selectedTab===1?'active':''">{{$t('home.free_text_search')}}</a>
          </div>
          <div
            class="bg-white w-4/5 mx-auto search-box flex md:flex-wrap xs:w-full md:w-3/4">
            <div class="w-full h-full flex items-center justify-between" :class="selectedTab===0?'':'hidden'">
              <ul
                class="filter-search h-full px-8 items-center justify-between flex justify-between flex-wrap w-full md:p-2 list-reset">
                <li class="md:w-1/2 px-4 md:px-0 md:py-4 relative h-full flex items-center"
                    :class="{ active : active_el === 1 }" @click="activate(1)">
                  <div class="md:flex md:items-center md:justify-between md:px-2">
                    <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.apartment_type')}} </span>
                    <i
                      class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                  </div>
                  <ais-refinement-list
                    :attribute="apartment_type"
                  />
                </li>
                <li class="md:w-1/2 px-4 md:px-0 md:py-4 relative h-full flex items-center"
                    :class="{ active : active_el === 2 }" @click="activate(2)">
                  <div class="md:flex md:items-center md:justify-between md:px-2">
                    <span
                      class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.bedrooms')}} </span>
                    <i
                      class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                  </div>
                  <ais-refinement-list
                    :attribute="rooms"
                  />
                </li>
                <li class="md:w-1/2 px-4 md:px-0 md:py-4 relative h-full flex items-center"
                    :class="{ active : active_el === 3 }" @click="activate(3)">
                  <div class="md:flex md:items-center md:justify-between md:px-2">
                    <span
                      class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.price')}} </span>
                    <i
                      class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                  </div>
                  <ais-refinement-list
                    :attribute="price"
                  />
                  <!--                  <ais-numeric-menu-->
                  <!--                    attribute="price"-->
                  <!--                    :items="[-->
                  <!--                              {label: $t('home.less_than')+' '+this.getPrice(('500k')), end: 50000},-->
                  <!--                              {label: ' '+this.getPrice(formatPrice('500000'))+' '+ '-' +' '+this.getPrice(formatPrice('1000000')), end: 1000000, start: 500000},-->
                  <!--                              {label: ' '+this.getPrice(formatPrice('1000000'))+' '+ '-' +' '+this.getPrice(formatPrice('1500000')), end: 1500000, start: 1000000},-->
                  <!--                              {label: ' '+this.getPrice(formatPrice('1500000'))+' '+ '-' +' '+this.getPrice(formatPrice('2000000')), end: 2000000, start: 1500000},-->
                  <!--                              {label: ' '+this.getPrice(formatPrice('2000000'))+' '+ '-' +' '+this.getPrice(formatPrice('2500000')), end: 2500000, start: 2000000},-->
                  <!--                              {label: ' '+this.getPrice(formatPrice('2500000'))+' '+ '-' +' '+this.getPrice(formatPrice('3000000')), end: 3000000, start: 2500000},-->
                  <!--                              {label: $t('home.more_than')+' '+this.getPrice(formatPrice('3000000')), start: 3000000},-->
                  <!--                          ]"-->
                  <!--                  >-->

                  <!--                    -->
                  <!--                    <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                  <!--                      <li v-for="item in items" :key="item.value">-->
                  <!--                        <a-->
                  <!--                          :href="createURL(item.value)"-->
                  <!--                          :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                  <!--                          :class="item.isRefined ? 'active' : ''"-->
                  <!--                          @click.prevent="refine(item.value)"-->
                  <!--                        >-->
                  <!--                          {{ item.label }}-->
                  <!--                        </a>-->
                  <!--                      </li>-->
                  <!--                    </ul>-->
                  <!--                  </ais-numeric-menu>-->
                </li>
                <li class="md:w-1/2 px-4 md:px-0 md:py-4 relative h-full flex items-center"
                    :class="{ active : active_el === 4 }" @click="activate(4)">
                  <div class="md:flex md:items-center md:justify-between md:px-2">
                    <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.total_area')}} </span>
                    <i
                      class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                  </div>
                  <ais-refinement-list
                    :attribute="area"
                  />
                  <!--                  <ais-numeric-menu-->
                  <!--                    attribute="total_area"-->
                  <!--                    :items="[-->
                  <!--                              {label: $t('home.all')},-->
                  <!--                              {label: $t('home.less_than')+' 50 '+$t('home.m2'), end: 50},-->
                  <!--                              {label: $t('home.between')+' 50 '+ $t('home.m2') +' '+$t('home.and')+' 100 '+ $t('home.m2'), end: 100, start: 50},-->
                  <!--                              {label: $t('home.between')+' 100 '+ $t('home.m2') +' '+$t('home.and')+' 150 '+ $t('home.m2'), end: 150, start: 100},-->
                  <!--                              {label: $t('home.between')+' 150 '+ $t('home.m2') +' '+$t('home.and')+' 200 '+ $t('home.m2'), end: 200, start: 150},-->
                  <!--                              {label: $t('home.between')+' 200 '+ $t('home.m2') +' '+$t('home.and')+' 250 '+ $t('home.m2'), end: 250, start: 200},-->
                  <!--                              {label: $t('home.more_than')+' 250 '+ $t('home.m2'), start: 250},-->
                  <!--                          ]"-->
                  <!--                  >-->
                  <!--                    <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                  <!--                      <li v-for="item in items" :key="item.value">-->
                  <!--                        <a-->
                  <!--                          :href="createURL(item.value)"-->
                  <!--                          :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                  <!--                          :class="item.isRefined ? 'active' : ''"-->
                  <!--                          @click.prevent="refine(item.value)"-->
                  <!--                        >-->
                  <!--                          {{ item.label }}-->
                  <!--                        </a>-->
                  <!--                      </li>-->
                  <!--                    </ul>-->
                  <!--                  </ais-numeric-menu>-->
                </li>
              </ul>
            </div>
            <div class="w-full h-full" :class="selectedTab===1?'':'hidden'">
              <div
                class="filter-search px-8 flex items-center justify-between flex-wrap w-full md:px-2 md:py-6 h-full free-text">
                <input class="w-full h-full text-xl" type="text" @input="changeQuery" :placeholder="$t('home.search')"/>
              </div>

            </div>
            <div class="bg-dark-blue flex h-full search-icon md:w-full">
              <button type="submit"
                      class="flex items-center justify-center text-white text-2xl no-underline px-12 md:px-4 md:w-full md:py-4 md:text-base">
                <i
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
        active_el: null,
        apartment_type: 'apartment_type.name.' + this.$store.app.i18n.locale,
        price: 'meta.price.' + this.$store.app.i18n.locale,
        rooms: 'meta.rooms.' + this.$store.app.i18n.locale,
        area: 'meta.area.' + this.$store.app.i18n.locale,
        query: '',
      }
    },
    methods: {
      changeQuery($event) {
        this.query = $event.target.value;
      },
      getPrice(price) {
        if (this.$store.state.currency === 'try')
          return price;
        else
          return parseFloat((price / this.$store.state.currentRate).toString()).toFixed(2);
      },
      selectTab(index) {
        this.selectedTab = index;
      },
      submitSearch() {
        this.$router.push({
          path: `${this.$i18n.locale === 'ar' ? '' : '/' + this.$i18n.locale}/properties/istanbul${window.location.search?window.location.search+'&query=' + this.query:'?query=' + this.query}`,
        })
      },
      activate: function (el) {
        if (this.active_el === el)
          this.active_el = null;
        else
          this.active_el = el;
      },
      formatPrice(value) {
        let val = (value / 1).toFixed(0).replace('.', ',');
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      }
    },
  }
</script>

<style lang="scss" scoped>
  .hidden {
    display: none !important;
  }

  .container-content {
    bottom: 10%;
    @include respond-to-min-max-width(991px, 1366px) {
      bottom: 5%;
    }
    @include respond-to(576px) {
      bottom: 0;
    }
  }

  .search-box {
    height: 80px;
    border-radius: 15px;
    box-shadow: 0 30px 25px 0 rgba(0, 0, 0, 0.2);
    @include respond-to(991px) {
      height: auto;
    }
  }

  .filter-search {
    @include respond-to(991px) {
      padding: 0 15px;
    }
    @include respond-to(320px) {
      padding: 0;
    }

    li {
      position: relative;
      @include respond-to-min-width(991px) {
        &:before {
          content: '';
          position: absolute;
          right: -30px;
          top: 10px;
          bottom: 0;
          width: 1px;
          height: 60px;
          background: #f2f2f2;
        }
        &:last-child {
          &:before {
            display: none;
          }
        }
      }

    }
  }


  html[dir='rtl'] .custom-filter {
    a .ais-Highlight {
      display: inline-block;
      width: 120px;
      position: relative;
      z-index: 9;

    }
  }

  html[dir='ltr'] .custom-filter {
    a .ais-Highlight {
      display: inline-block;
      width: 120px;
      position: relative;
      z-index: 9;

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

<style lang="scss">
  .home-page,
  .blog-details-page,
  .estate-details-page {
    /* Custom Algolia */
    .ais-NumericMenu .custom-filter,
    .ais-RefinementList .custom-filter,
    .ais-RefinementList-list {
      list-style: none;
      padding: 0;
      position: absolute;
      right: 0;
      left: 0;
      width: 300px;
      top: 100%;
      background: #fff;
      border-bottom-right-radius: 10px;
      border-bottom-left-radius: 10px;
      z-index: 7;
      max-height: 0;
      overflow: hidden;
      @include respond-to(411px) {
        width: 270px;
      }

      li {

        a {
          color: #1a4066;
          font-size: 14px;
          text-decoration: none;
        }

        label {
          padding: 10px 15px;
          cursor: pointer;

        }
      }

      ul {
        list-style: none;
        @include respond-to(576px) {
          padding: 0;
        }

        li {

          a {
            color: #1a4066;
            font-size: 14px;
            text-decoration: none;
          }

          label {
            padding: 10px 15px;
            cursor: pointer;
          }
        }
      }
    }

    .active {
      .ais-RefinementList .custom-filter,
      .ais-NumericMenu .custom-filter,
      .ais-RefinementList-list {
        max-height: 400px;
        @include box-shadow(0px 0px 5px 1px rgba(0, 0, 0, 0.2));
      }
    }

    .filter-search {
      li {
      }

      input[type="radio"] {
        width: 15px;
        height: 15px;
        border: none;
        box-shadow: none;
        appearance: none;

        &:before {
          content: '';
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
      }

      input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border: none;
        box-shadow: none;
        appearance: none;
        position: relative;

        &:before {
          content: '';
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
            content: '';
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
    }

  }

  .free-text {
    @include placeholder(#5b8da6, get-vw(30px), 500);
    @include respond-to(991px) {
      @include placeholder(#5b8da6, 16px, 500);
    }


    input {
      font-size: get-vw(30px);
      color: #5b8da6;
      @include respond-to(991px) {
        font-size: 18px;
        padding: 30px 15px;
      }
    }
  }

  .ais-RefinementList-item {
    position: relative;
  }

  .ais-RefinementList-label {
    display: block;
    z-index: 99;
  }

  .ais-RefinementList-count {
    position: absolute;
    background: #3489d8;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    top: 10px;
    color: #fff;
  }

  html[dir='ltr'] .ais-RefinementList-count {
    right: 20px;

  }

  html[dir='rtl'] .ais-RefinementList-count {
    left: 20px;
  }

  html[dir='ltr'] .filter-search {
    li {
      &:nth-child(even) {
        @include respond-to(576px) {
          .ais-RefinementList-list {
            z-index: 30;
            left: -130px;
          }
        }
      }

    }
  }

  html[dir='rtl'] .filter-search {
    li {
      &:nth-child(even) {
        @include respond-to(576px) {
          .ais-RefinementList-list {
            z-index: 30;
            right: -130px;
          }
        }
      }

    }
  }
</style>
