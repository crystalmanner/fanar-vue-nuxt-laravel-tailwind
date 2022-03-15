<template>
  <div class="main-header">
    <div class="top-bar absolute pin-t pin-x">
      <div
        class="container-content flex content-center justify-between"
        itemscope
        itemtype="http://schema.org/URL"
      >
        <div class="phone-number bg-white rounded-b-lg h-8 flex items-center">
          <a
            class="text-main-color text-xs font-bold flex items-center no-underline px-2 xxs:px-1"
            :href="'tel:'+settings.Phone2"
            itemprop="url"
            dir="ltr"
          >
            <i class="fas fa-phone ltr:pr-2 rtl:pl-2 text-dark-blue"></i>
            {{settings.Phone2}}
          </a>
        </div>
        <div class="options bg-white rounded-b-lg h-8 flex items-center">
          <a
            class="text-main-color font-bold text-sm px-2 no-underline xxs:px-1 lang"
            :class="{isDisabled:isBlog}"
            temprop="url"
            v-for="locale in availableLocales"
            :key="locale.code"
            :href="switchLocalePath(locale.code)"
          >
            {{ locale.code=='en'?'En':'العربية' }}
            <img
              class="ltr:pl-2 rtl:pr-2 flag"
              :src="locale.code=='en'?'/img/en.svg':'/img/ar.png'"
              alt
            />
          </a>
          <span
            class="text-main-color font-bold text-xs px-2 xxs:px-1 drop-menu relative cursor-pointer"
          >
            <span class="coin" dir="ltr">TRY (₺)</span>
            <ul class="submenu list-reset" dir="ltr">
              <li>
                <a @click.prevent="changeCurrency('try')">TRY (₺)</a>
              </li>
              <li>
                <a @click.prevent="changeCurrency('usd')">USD ($)</a>
              </li>
            </ul>
          </span>
        </div>
      </div>
    </div>
    <header id="header" class="absolute pin-t pin-x">
      <div class="container-content relative">
        <div class="fanar-logo">
          <n-link :to="localePath('index')">
            <img src="/img/main-logo.png" alt="image" class="main-logo ImageLogo" />
            <span>Fanar</span>
          </n-link>
          <n-link :to="localePath('index')" class="custom-logo">
            <img src="/img/fanar-logo.png" alt="ImageLogo" />
            <span>Fanar</span>
          </n-link>
        </div>
        <nav class="flex items-center justify-end flex-wrap py-2 menu-grid">
          <ul
            class="w-full flex items-center lg:w-auto main-menu list-reset"
            itemscope
            itemtype="http://schema.org/URL"
          >
            <li
              v-for="(item,index) in menuHeader"
              :key="index"
              class="ltr:mr-5 rtl:ml-5"
              :class="item.id===3 || item.id===9?'droping':''"
            >
              <n-link
                :to="item.value!=='properties/istanbul'? localePath(item.value) : localePath('properties')+'/istanbul'"
                class="no-underline text-blue-shadow text-base font-bold"
                itemprop="url"
              >
                {{item.name}}
                <span v-if="item.children.length">
                  <i class="fas fa-chevron-down"></i>
                </span>
                <!--                <span v-if="item.id===3 || item.id===9"><i class="fas fa-chevron-down"></i></span>-->
              </n-link>
              <!--              <ul class="list-reset bg-white absolute rounded-lg drop-down flex flex-wrap items-center" v-if="item.id===3 || item.id===9">-->
              <!--                <li class="px-6 py-4 w-1/3 flex items-center" v-for="(item,index) in subMenu" :key="index" v-if="item.image && item.name">-->
              <!--                  <img class="list-img mr-4" :src="item.image" alt="" v-if="item.image">-->
              <!--                  <div>-->
              <!--                    <a href="#" class="text-dark-blue font-bold text-lg no-underline p-0" v-if="item.name">{{item.name}}</a>-->
              <!--                    <p class="text-sm font-bold text-blue-shadow mt-2" v-if="item.apartments_count">{{item.apartments_count}} Properties</p>-->
              <!--                  </div>-->
              <!--                </li>-->
              <!--              </ul>-->
            </li>
          </ul>
        </nav>
        <button type="button" class="hamburger unactive hamburger-menu">
          <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
          <span class="hamb-bottom"></span>
        </button>
      </div>
    </header>
    <!--    <div>-->
    <!--      <div class="px-6 py-4 bg-white anas" v-for="(item,index) in subMenu" :key="index">-->
    <!--        <a class="text-dark-blue font-bold text-lg no-underline p-0">{{item.name}}</a>-->
    <!--      </div>-->
    <!--    </div>-->
  </div>
</template>

<script>
export default {
  computed: {
    availableLocales() {
      return this.$i18n.locales.filter(i => i.code !== this.$i18n.locale);
    },
    menuHeader() {
      const item = this.$store.state.menu.find(x => x.slug === "header");
      return _.has(item, "root_menu_items") ? item.root_menu_items : null;
    },
    subMenu() {
      return this.$store.state.subMenu;
    },
    settings() {
      return this.$store.state.settings;
    },
    isBlog() {
      const pathName = this.$route.name.slice(0, 4);
      return pathName == "blog";
    }
  },
  methods: {
    changeLang(link) {
      location.replace(link);
    },
    changeCurrency(currency) {
      this.$store.dispatch("getCurrency", currency);
    }
  }
};
</script>

<style lang="scss" scoped>
.droping {
  &:hover {
    transition: all 0.3s ease-in-out;

    .drop-down {
      max-height: 500px;
    }
  }
}
.list-img {
  width: 75px;
  height: 75px;
  object-fit: cover;
  @include border-radius(10px);
  @include respond-to-min-width(1600px) {
    width: 80px;
    height: 80px;
  }
}
.fa-chevron-down {
  @include respond-to(1020px) {
    display: none;
  }
}
.drop-down {
  top: 90px;
  overflow: hidden;
  transition: all 0.3s ease-in-out;
  left: 0;
  right: 0;
  width: 100%;

  max-height: 0;
  @include respond-to(1020px) {
    display: none;
  }
  li {
    border-bottom: 1px solid #f2f2f2;
    &:last-child a,
    a {
      color: #3489d8 !important;
      padding: 0 !important;
      background: #fff !important;
      border: none !important;
      &:hover {
        color: #5b8da6 !important;
      }
    }

    &:last-child {
      border-bottom: none;
    }
  }
}

.sticky .main-header #header nav .drop-down li:last-child a {
  background: transparent !important;
  border: none !important;
  color: #3489d8 !important;

  &:hover {
    color: #5b8da6 !important;
  }
}

.isDisabled {
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}

.lang {
  position: relative;

  &:before {
    content: "";
    width: 1px;
    height: 32px;
    position: absolute;
    top: -8px;
    bottom: 0;
    background: #f2f2f2;
  }
}

html[dir="ltr"] .lang {
  &:before {
    right: 0;
  }
}

html[dir="rtl"] .lang {
  &:before {
    left: 0;
  }
}

.main-header {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 9;
  transition: all 0.3s ease-in-out;
  height: 110px;
  background: #fff;
}

.options,
.phone-number {
  box-shadow: 0 15px 20px 0 rgba(0, 0, 0, 0.05);
}

.body-overflow {
  overflow: hidden;
}

.container-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.top-bar {
  z-index: 10;
}

.flag {
  max-width: 28px;
}

#header {
  transition: all 0.3s ease-in-out;
  z-index: 2;
  top: 40px;

  nav {
    transition: all 0.3s ease-in-out;

    a {
      &:hover {
        color: #3489d8;
      }
    }

    li:last-child {
      a {
        padding: 8px 15px;
        @include border-radius(10px);
        border: 1px solid #3489d8;
        background-color: #3489d8;
        color: #fff;

        &:hover {
          background: transparent;
          color: #3489d8;
        }
      }
    }
  }

  .fanar-logo {
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease-in-out;
    @media screen and (max-width: 1020px) {
      width: 60%;
      padding: 20px 10px;
      display: block;
      margin-right: auto;
      text-align: left;
      line-height: 0;
    }

    a {
      display: inline-block;
      line-height: 0;
      margin-right: auto;
    }

    img {
      transition: all 0.3s ease-in-out;
      width: 70%;
    }

    span {
      display: none;
    }
  }

  .menu-grid {
    flex-grow: 1;
    @media screen and (max-width: 1020px) {
      position: fixed;
      left: 0;
      top: 0;
      width: 100vw;
      height: 100vh;
      overflow-y: auto;
      z-index: 8;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      transition: all 0.35s;
      opacity: 0;
      visibility: hidden;
      background: #fff;
      a {
        color: #3489d8 !important;
      }
      li:last-child a {
        border-color: #3489d8 !important;
        background-color: #3489d8 !important;
        color: #fff !important;
      }
      &.active {
        opacity: 1;
        visibility: visible;

        .main-menu {
          transform: translate(0);
          text-align: center;

          li {
            display: block;
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 34px;
          }
        }
      }
    }
  }

  .main-menu {
    li a {
      transition: all 0.25s;
    }

    @media screen and (max-width: 1020px) {
      text-align: center;
      transition: all 0.25s;
      transform: translate(0, 100px);
      display: block;
      li {
        display: block;
        margin-bottom: 34px;
        transition: all 0.25s;

        a {
          display: inline-block;
          margin-left: 0;
          margin-right: 0;
          transition: all 0.25s;
          font-size: 24px;
        }
      }
      .logo-handler {
        display: none !important;

        img {
          transition: all 0.3s ease-in-out;
        }
      }
    }
  }
}

.sticky {
  top: 0;
  transition: all 0.3s ease-in-out;
  #header {
    top: 20px;
  }
  #header,
  .top-bar {
    transition: all 0.3s ease-in-out;
  }
  .drop-down {
    top: 80px;
  }

  .main-header {
    height: 95px;
    transition: all 0.3s ease-in-out;
    @include box-shadow(0px 5px 10px 0px rgba(0, 0, 0, 0.53));
    background-color: #fff;

    #header nav {
      //padding: 0.5rem 0;
      transition: all 0.3s ease-in-out;

      a {
        color: #3489d8 !important;

        &:hover {
          color: #5b8da6 !important;
        }
      }

      li:last-child {
        a {
          border-color: #3489d8 !important;
          background-color: #3489d8 !important;
          color: #fff !important;

          &:hover {
            background-color: #fff !important;
            color: #3489d8 !important;
            border-color: #3489d8 !important;
          }
        }
      }
    }
  }

  .fanar-logo {
    padding-top: 18px !important;
    img {
      transition: all 0.3s ease-in-out;
      width: 60%;
    }
  }
}

/* Hamburger */
.hamburger {
  width: 38px;
  height: 34px;
  border: none;
  position: absolute;
  right: 15px;
  z-index: 9;
  -webkit-transition: background-color 0.2s linear, top 0.3s;
  -ms-transition: background-color 0.2s linear, top 0.3s;
  transition: background-color 0.2s linear, top 0.3s;
  cursor: pointer;
  display: none;
  outline: none;
  background: #fff;
  padding: 6px 4px;
  @include border-radius(4px);

  &:focus {
    outline: none;
  }
}

html[dir="ltr"] .hamburger {
  right: 15px;
}

html[dir="rtl"] .hamburger {
  right: 15px;
}

@media screen and (max-width: 1020px) {
  .hamburger {
    display: block;
  }
}

.hamburger:hover span:nth-child(1) {
  transform: translate(0, -2px);
  -webkit-transform: translate(0, -2px);
  -ms-transform: translate(0, -2px);
}

.hamburger:hover span:nth-child(3) {
  transform: translate(0, 2px);
  -webkit-transform: translate(0, 2px);
  -ms-transform: translate(0, 2px);
}

.hamburger.active span:nth-child(1) {
  transform: rotate(45deg) translate(5px, 5px);
  -webkit-transform: rotate(45deg) translate(5px, 5px);
  -ms-transform: rotate(45deg) translate(5px, 5px);
  margin-bottom: 3px;
}

.hamburger.active span:nth-child(2) {
  transform: translate(-4px, 0);
  -webkit-transform: translate(-4px, 0);
  -ms-transform: translate(-4px, 0);
  opacity: 0;
}

.hamburger.active span:nth-child(3) {
  transform: rotate(-45deg) translate(5px, -5px);
  -webkit-transform: rotate(-45deg) translate(5px, -5px);
  -ms-transform: rotate(-45deg) translate(5px, -5px);
  margin-bottom: 3px;
}

.hamburger span {
  width: 100%;
  height: 3px;
  background-color: #3489d8;
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
  -webkit-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  -ms-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

ul.submenu {
  max-height: 0;
  padding: 0;
  overflow: hidden;
  background: white;
  transition: max-height 0.5s ease-out;
  position: absolute;
  top: 19px;
  min-width: 100%;
  width: 90px;
  text-align: center;

  a {
    display: block;
    padding: 12px;
    color: #1a4066;
    text-decoration: none;
    transition: background 0.3s;
    border-bottom: 1px solid;
    border-color: rgba(0, 0, 0, 0.6);
    white-space: nowrap;

    &:hover {
      transition: all 0.3s ease-in-out;
      color: #cea660;
    }
  }

  &.active {
    max-height: 250px;
  }
}

html[dir="ltr"] ul.submenu {
  left: -25px;
  @include respond-to(576px) {
    left: -41px;
  }
}

html[dir="rtl"] ul.submenu {
  right: -25px;
  @include respond-to(576px) {
    right: -41px;
  }
}
</style>


