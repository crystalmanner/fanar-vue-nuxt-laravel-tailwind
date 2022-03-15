<template>
  <div class="padding-menu">
    <div class="service-page pb-12">
      <div class="title-bar bg-dark-blue text-white py-8 text-center mb-16 md:mb-10">
        <h1 class="text-lg uppercase">{{title}}</h1>
      </div>
      <div class="container-content">
        <div class="serivce-content bg-white rounded-lg">
          <ul v-if="content"
              class="list-reset flex items-center justify-around sm:justify-between bg-white rounded-t-lg pb-6 sm:pb-4">
            <li class="">
              <a @click.prevent="selectTab(0)" :class="selectedTab===0?'active':''"
                 class="inline-block text-blue-shadow px-4 py-6 no-underline text-center font-bold sm:font-normal sm:px-2"
                 href="#">
                <svg class="mb-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="63" height="53" viewBox="0 0 63 53">
                  <image width="63" height="53"
                         xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD8AAAA1CAYAAAD2xDO5AAACN0lEQVRoge2av0vcYBjHP5eeS8Eugou7QhcVFHs46KDgWB0KQkFcbKGT003XpTjUP0AqLoqLW0vpUCl0cCgKrhWdFMFBWqHDIbfolad9I6GeNpcfz5u7Nx/Icpc39/08SS7vk6Qw9PaQAOPAc6Af6ASuaH0eADXgCHgPbPlGxYDaO+BFG8jehezQZ8BL4CnwyzMrrre5eJAxYE+OCJGfAOayk02FXmBJ5MsOyDZiVuQHs5dLhUci/9AB0UZ0eG1yOYvCtcjXWy93MngaP5JVcnlXyeVdJZe3SM1V+WOgD1izFcCW/A4wDJwCC8CKjRA25D+Ynvoi8NkrG92ltrzcRpq+47tl7QJoyov4zH/WUS2AlnwYcR+1AmjIf2pC3EcKUEkv0l805DcijltNOMctNOS7I47rSTjHLTTkC8rjQpPP7VPmIuLmz9IOVgyxTlwGgAPzzCws18DjtINpyJez+mAkP+ddJZd3lVzeVTyHC1DwYsy9Wx6RP3fUvSbyHzMQxAYnIr/knvcfKiL/A5jKQBhN3gCf/X/6baAEfGtz6RNgHnjNP13dLjAKDJmly7yv0+xrK7LNRTM+SZbNvYFmrk4F00pfAt+BL0GfRi3tvlnisGru2o4kIF8FJs3OSZS0Jjg/zWm0F3M7VXMUJi5OyrO7eswC+OJHCee6Ie2prRTgSYQ9l7o4ivP6UhMFUBFHuakJcylVE8dCRzd6TwFUxbHUzjYqgLq4YKuXlwJsGtmv5rV3VXGA3+T9XCxC6IVnAAAAAElFTkSuQmCC"/>
                </svg>
                <h3 class="text-3xl sm:text-xs font-bold" v-if="content.consultancy">
                  <span class="text-lg sm:text-xs block">{{content.consultancy.subtitle}}</span>
                  {{content.consultancy.title}}
                </h3>
              </a>
            </li>
            <li class="">
              <a @click.prevent="selectTab(1)" :class="selectedTab===1?'active':''"
                 class="inline-block p-4 text-blue-shadow py-6 no-underline text-center font-bold sm:font-normal sm:px-2"
                 href="#">
                <svg class="mb-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="55" height="63" viewBox="0 0 55 63">
                  <image id="Forma_1" data-name="Forma 1" width="55" height="63"
                         xlink:href="data:img/png;base64,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"/>
                </svg>
                <h3 class="text-3xl sm:text-xs font-bold" v-if="content.marketing">
                  <span class="text-lg sm:text-xs block">{{content.marketing.subtitle}}</span>
                  {{content.marketing.title}}
                </h3>
              </a>
            </li>
            <li class="">
              <a @click.prevent="selectTab(2)" :class="selectedTab===2?'active':''"
                 class="inline-block p-4 text-blue-shadow py-6 no-underline text-center font-bold sm:font-normal sm:px-2"
                 href="#">
                <svg class="mb-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="63"
                     height="58" viewBox="0 0 63 58">
                  <image id="L1" width="63" height="58"
                         xlink:href="data:img/png;base64,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"/>
                </svg>
                <h3 class="text-3xl sm:text-xs font-bold" v-if="content.tours">
                  <span class="text-lg sm:text-xs block">{{content.tours.subtitle}}</span>
                  {{content.tours.title}}
                </h3>
              </a>
            </li>
          </ul>
          <div class="serivce-tab px-8 pb-6 sm:px-4" v-if="content">
            <div :class="selectedTab===0?'':'hidden'" v-if="content.consultancy">
              <div class="service-img mb-6">
                <img class="w-full rounded-t-lg" src="/img/service-img.png" alt="">
              </div>
              <div class="editor-text" v-html="content.consultancy.description"></div>
            </div>
            <div :class="selectedTab===1?'':'hidden'" v-if="content.marketing">
              <div class="service-img mb-6">
                <img class="w-full rounded-t-lg" src="/img/service-img2.png" alt="">
              </div>
              <div class="editor-text" v-html="content.marketing.description"></div>
            </div>
            <div :class="selectedTab===2?'':'hidden'" v-if="content.tours">
              <div class="service-img mb-6">
                <img class="w-full rounded-t-lg" src="/img/service-img3.png" alt="">
              </div>
              <div class="editor-text" v-html="content.tours.description"></div>
            </div>
          </div>
        </div>
        <div class="contact-box bg-white rounded-lg mt-4">
          <div class="p-8">
            <h3>{{$t('home.leave_your_contact_information')}}</h3>
            <form class="ltr:text-left rtl:text-right mt-4" novalidate @submit.prevent="validateBeforeSubmit">
              <div class="mb-4">
                <label class="block text-main-color text-xs font-bold mb-2" for="phone-number">
                  {{$t('home.phone_number')}} <span class="required">*</span>
                </label>
                <div class="input-handler relative border rounded-full w-full py-2 px-4 flex"
                     :class="{ 'has-danger': errors.has('mobile') }">
                  <div class="input-number flex items-center w-2/6">
                    <vue-country-code class="text-blue-shadow text-sm w-full bg-transparent"
                                      :enabledCountryCode="true" :defaultCountry="'TR'"
                                      :disabledFetchingCountry="true" @onSelect="onSelect">
                    </vue-country-code>
                  </div>
                  <input class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                         id="phone-number"
                         type="text"
                         :placeholder="$t('home.phone_number')" v-validate="'required|numeric'"
                         v-model="call.mobile"
                         name="mobile">
                </div>
                <div class="text-red block" v-if="errors.firstRule('mobile')">{{ errors.first('mobile') }}</div>
              </div>
              <div class="mb-4">
                <label class="block text-main-color text-xs font-bold mb-2" for="phone-number">
                  {{$t('home.your_name')}}
                </label>
                <div class="input-handler relative border rounded-full w-full py-3 px-4 flex">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                         type="text"
                         :placeholder="$t('home.your_name')" v-model="call.name">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-main-color text-xs font-bold mb-2" for="phone-number">
                  {{$t('home.your_email')}}
                </label>
                <div class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                     :class="{ 'has-danger': errors.has('email') }">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                         type="text"
                         :placeholder="$t('home.your_email')" v-validate="'email'" name="email"
                         v-model="call.email">
                </div>
                <div class="text-red block" v-if="errors.firstRule('email')">{{ errors.first('email') }}</div>
              </div>
              <div class="flex items-center justify-center mt-6 mb-4">
                <button class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full w-full"
                        type="submit">
                  {{$t('home.send')}}
                </button>
              </div>
              <div :class="success===true?'':'hidden'"
                   class="bg-red-100 border border-green text-green px-4 py-3 rounded relative" role="alert">
                <span class="block">{{$t('home.sent_successfully')}}</span>
              </div>
            </form>
          </div>
        </div>
      </div>
      <ContactUs/>
    </div>
  </div>
</template>
<script>
  import ContactUs from '~/components/contact-us'
  import axios from '~/plugins/axios.js';
  import "vue-country-code/dist/vue-country-code.css";

  export default {
    head() {
      return {
        title: this.$t('app.name') + ' - ' + this.title,
        meta: this.services.seo
      }
    },
    data() {
      return {
        selectedTab: 0,
        call: {
          mobile: '',
          code: '',
          name: '',
          email: '',
          page: this.$route.path
        },
        success: false,
        error: false,
        errorMsgs: [],
      }
    },
    methods: {
      selectTab(index) {
        this.selectedTab = index;
      },
      validateBeforeSubmit(event) {
        this.$validator.resume();
        this.$validator.validate().then((result) => {
          if (result) {
            //// eslint-disable-next-line
            axios.post('/api/call', {
              code: this.call.code,
              mobile: this.call.mobile,
              name: this.call.name,
              email: this.call.email,
              page: this.call.page
            }).then((res) => {
              this.success = true;
              const $this = this;
              setTimeout(function () {
                $this.call = {
                  mobile: null,
                  email: null,
                };
                $this.$validator.pause();
                $this.success = false;
              }, 3000);
            }).then(() => {
              this.errors.clear();
            }).catch((res) => {
              this.error = true;
              const $this = this;
              // if (res.response.data.errors.code) {
              //   this.errorMsgs = res.response.data.errors.code[0];
              // }
              // if (res.response.data.errors.mobile) {
              //   this.errorMsgs = res.response.data.errors.mobile[0];
              // }
              setTimeout(function () {
                $this.error = false;
              }, 3000);
            });
            return;
          }
        });
      },
      onSelect({name, iso2, dialCode}) {
        this.call.code = dialCode;
      },
    },
    components: {
      ContactUs
    },
    async asyncData({store, error}) {
      let res = await Promise.all([
        store.dispatch('getCurrentPage', 'services'),
        store.dispatch('getPage', {lang: store.app.i18n._vm.locale, page: 'services'})
      ]);
    },
    computed: {
      services() {
        return this.$store.state.page;
      },
      title() {
        return this.services ? this.services.title : this.$t('links.service');
        // const item = this.services.seo.find((x=> {return x.name==='title'}));
        // return item ? item.content : this.$t('links.service');
      },
      content() {
        return this.services.content;
      },
    },
    mounted() {
      // window.main.init();
    }
  }
</script>

<style lang="scss">
  .service-page {
    background-color: #f7f7f7;

    .service-img {
      img {
        height: 350px;
        object-fit: cover;
      }
    }

    .active {
      color: #3489d8;
    }
  }
</style>
