<template>
  <div>
    <footer class="py-12 md:py-8">
      <div class="container-content">
        <div class="flex flex-wrap">
          <div class="w-1/3 md:w-full">
            <h4 class="uppercase text-xs text-blue-shadow font-bold mb-4">{{$t('app.name')}}</h4>
            <p class="text-main-color text-sm mb-4"><i class="fas fa-envelope ltr:pr-2 rtl:pl-2 text-dark-blue"></i> <a
              href="mailto:info@fanarrealty.com" class="text-main-color no-underline hover:text-dark-blue">{{settings.Email}}</a>
            </p>
            <p class="text-main-color text-sm mb-4"><i class="fas fa-phone ltr:pr-2 rtl:pl-2 text-dark-blue"></i>
              <span dir="ltr">{{settings.Phone1}}</span> <span class="px-4">|</span> <span dir="ltr">{{settings.Phone2}}</span></p>
            <p class="text-main-color text-sm mb-4"><i class="fas fa-map-marker-alt text-dark-blue"></i> {{address}}</p>
          </div>
          <div class="w-2/3 ltr:pl-20 rtl:pr-20 md:w-full md:ltr:pl-0 md:ltr:pl-0 md:rtl:pr-0">
            <div class="mb-8" v-if="menuFooter1">
              <h4 class="uppercase text-xs text-blue-shadow font-bold mb-4">{{menuFooter1.name}}</h4>
              <ul class="flex items-center justify-between list-reset md:flex-wrap">
                <li class="md:w-1/2 md:mb-2" v-for="(item,index) in menuFooter1.root_menu_items" :key="index">
                  <n-link :to="localePath(item.value)"
                          class="no-underline text-main-color text-sm flex items-center justify-center uppercase hover:text-dark-blue md:justify-start">
                    {{item.name}}
                  </n-link>
                </li>
              </ul>
            </div>
            <div v-if="menuFooter2">
              <h4 class="uppercase text-xs text-blue-shadow font-bold mb-4">{{menuFooter2.name}}</h4>
              <ul class="flex items-center justify-between list-reset md:flex-wrap">
                <li class="md:w-1/2 md:mb-2" v-for="(item,index) in menuFooter2.root_menu_items" :key="index">
                  <n-link :to="localePath(item.value)"
                          class="no-underline text-main-color text-sm flex items-center justify-center uppercase hover:text-dark-blue md:justify-start">
                    {{item.name}}
                  </n-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div class="footer-bar">
      <div class="container-content flex items-center justify-center">
        <p class="text-main-color text-sm  py-10 md:py-6 uppercase">© 2019 <span class="font-bold">{{$t('app.name')}}</span> {{$t('home.all_rights_reserved')}}</p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    computed: {
      menuFooter1() {
        return this.$store.state.menu.find((x) => x.slug === 'support');
      },//root_menu_items
      menuFooter2() {
        return this.$store.state.menu.find((x) => x.slug === 'links');
      },
      settings() {
        return this.$store.state.settings;
      },
      address() {
        return this.$i18n.locale === 'en' ? this.$store.state.settings.Address : this.$store.state.settings.Address_Ar;
      },
    },
  }
</script>

<style lang="scss" scoped>
  footer {
    background-color: #fff;

    a {
      @include transition_default();
    }
  }

  .footer-bar {
    background-color: #fff;
    .container-content {
      border-top: 1px solid #f2f2f2;
    }
  }
  .custom-header{
    footer{
      background-color: #f7f7f7;
    }
    .footer-bar {
      background-color: #f7f7f7;
    }
  }
</style>
