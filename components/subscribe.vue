<template>
  <div class="subscribe pb-12 md:pb-6">
    <div class="subscribe-box bg-white text-center">
      <h3 class="text-main-color text-2xl mb-12 md:mb-8 md:mx-4 md:text-lg font-bold" v-if="sectionTitle === 'name.ar'">{{settings.newsletter_title_ar}}</h3>
      <h3 class="text-main-color text-2xl mb-12 md:mb-8 md:mx-4 md:text-lg font-bold" v-else-if="sectionTitle === 'name.en'">{{settings.newsletter_title_en}}</h3>
      <div class="w-3/5 subscribe-width mx-auto md:w-full md:px-6">
        <form novalidate @submit.prevent="validateBeforeSubmit">
          <div class="mb-4 flex md:flex-wrap items-center justify-between">
            <div :class="{ 'has-danger': errors.has('email') }"
                 class="input-handler relative border rounded-full w-3/5 py-3 px-4 flex flex-grow ltr:mr-8 rtl:ml-8 md:w-full md:ltr:mr-0 md:rtl:ml-0 md:mb-6">
              <div class="input-number">
                <i class="fas fa-phone text-dark-blue ltr:pr-3 rtl:pl-3"></i>
              </div>
              <input v-validate="'email'" name="email" v-model="newsletter.email"
                     class="appearance-none text-blue-shadow text-sm flex-grow bg-transparent" type="email"
                     :placeholder="$t('home.email_address')">
            </div>
            <button class="text-white font-bold text-sm custom-button py-3 px-10 rounded-full  md:mx-auto"
                    type="submit">
              {{$t('home.subscribe_now')}}
            </button>
          </div>
          <div class="text-red block" v-if="errors.firstRule('email')">{{ errors.first('email') }}</div>
          <div :class="success===true?'':'hidden'"
               class="bg-red-100 border border-green text-green px-4 py-3 rounded relative" role="alert">
            <span class="block">{{$t('messages.subscribed_successfully')}}</span>
          </div>
          <div :class="error===true?'':'hidden'"
               class="bg-red-100 border border-red text-red px-4 py-3 rounded relative" role="alert">
            <span class="block">{{errorMsgs}}</span>
          </div>
        </form>
      </div>
      <div class="social-media mt-8">
        <ul class="flex items-center justify-center list-reset" itemscope itemtype="http://schema.org/URL">
          <li class="ltr:mr-2 rtl:ml-2" v-if="settings.Facebook">
            <a :href="settings.Facebook" itemprop="url" target="_blank"
               class="no-underline text-dark-blue  rounded-full h-10 w-10 flex items-center justify-center hover:bg-dark-blue hover:text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="ltr:mr-2 rtl:ml-2" v-if="settings.Instagram">
            <a :href="settings.Instagram" itemprop="url" target="_blank"
               class="no-underline text-dark-blue  rounded-full h-10 w-10 flex items-center justify-center hover:bg-dark-blue hover:text-white">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
          <li class="ltr:mr-2 rtl:ml-2" v-if="settings.LinkedIn">
            <a :href="settings.LinkedIn" itemprop="url" target="_blank"
               class="no-underline text-dark-blue  rounded-full h-10 w-10 flex items-center justify-center hover:bg-dark-blue hover:text-white">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
          <li class="ltr:mr-2 rtl:ml-2" v-if="settings.Twitter">
            <a :href="settings.Twitter" itemprop="url" target="_blank"
               class="no-underline text-dark-blue  rounded-full h-10 w-10 flex items-center justify-center hover:bg-dark-blue hover:text-white">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from '~/plugins/axios.js';

  export default {
    data() {
      return {
        success: false,
        error: false,
        newsletter: {
          email: '',
        },
        errorMsgs: [],
        sectionTitle: 'name.' + this.$store.app.i18n.locale,
      }
    },
    computed: {
      settings() {
        return this.$store.state.settings;
      },
    },
    methods: {
      validateBeforeSubmit(event) {
        this.$validator.resume();
        this.$validator.validate().then((result) => {
          if (result) {
            //// eslint-disable-next-line
            axios.post('/api/newsletter', this.newsletter).then((res) => {
              this.success = true;
              const $this = this;
              setTimeout(function () {
                $this.newsletter = {
                  email: null
                };
                $this.$validator.pause();
                $this.success = false;
              }, 3000);
            }).then(() => {
              this.errors.clear();
            }).catch((res) => {
              this.error = true;
              const $this = this;
              this.errorMsgs = res.response.data.errors.email[0];
              setTimeout(function () {
                $this.error = false;
              }, 3000);
            });
            return;
          }
        });
      },
    }
  }
</script>

<style lang="scss" scoped>
  .subscribe-box {
    padding: 50px 0;
    border-radius: 10px;
    box-shadow: 0 20px 60px 0 rgba(0, 0, 0, 0.08);

    h3 {
      @include respond-to(767px) {
        font-size: 18px !important;
      }
    }

    .social-media {
      li > a {
        border: 1px solid #3489d8;
        @include transition_default();
      }
    }
  }

  html[dir='ltr'] .subscribe-box .input-number {
    border-right: none;
  }

  html[dir='rtl'] .subscribe-box .input-number {
    border-left: none;
  }
</style>
