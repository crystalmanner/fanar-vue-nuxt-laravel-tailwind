<template>
  <div class="padding-menu">
    <div class="forms-page">
      <div class="forms-img relative">
        <img class="w-full" src="/img/forms-img.png" :title="page.title" :alt="page.image_alt" />
        <div class="container-content absolute pin-b pin-x">
          <div
            class="form-title text-center bg-white p-8 w-4/5 mx-auto rounded-lg md:w-full md:px-2 md:py-4"
          >
            <h3
              class="font-bold text-3xl text-dark-blue mb-8 md:text-lg md:mb-4"
            >{{page.content.contact_description.title}}</h3>
            <p
              class="text-main-color text-base font-bold leading-normal md:text-sm contact-desc"
              v-html="page.content.contact_description.description"
            ></p>
          </div>
        </div>
      </div>
      <div class="container-content">
        <form novalidate @submit.prevent="validateBeforeSubmit">
          <div class="forms-content flex items-stretch sm:justify-center flex-wrap">
            <div class="w-1/2 sm:w-full sm:flex sm:flex-wrap sm:items-center sm:-mx-6">
              <div class="w-full px-6 sm:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  {{$t('call.name')}}
                  <!-- <span class="required">*</span> -->
                </label>
                <div class="input-handler" :class="{ 'has-danger': errors.has('name') }">
                  <input
                    class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg border border-transparent"
                    type="text"
                    :placeholder="$t('call.name')"
                    name="name"
                    v-model="call.name"
                  />
                </div>
              </div>
              <div class="w-full px-6 sm:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  {{$t('call.your-email')}}
                  <!-- <span class="required">*</span> -->
                </label>
                <div class="input-handler" :class="{ 'has-danger': errors.has('email') }">
                  <input
                    class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg border border-transparent"
                    type="text"
                    :placeholder="$t('call.your-email')"
                    v-validate="'email'"
                    name="email"
                    v-model="call.email"
                  />
                </div>
                <div
                  class="text-red block"
                  v-if="errors.firstRule('email')!=='required'"
                >{{ errors.first('email') }}</div>
              </div>
              <div class="w-full px-6 sm:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  {{$t('call.phone-number')}}
                  <span class="required">*</span>
                </label>
                <div
                  class="input-handler relative rounded-lg w-full flex items-center bg-white"
                  :class="{ 'has-danger': errors.has('mobile') }"
                >
                  <div class="input-number px-3">
                    <vue-country-code
                      class="text-blue-shadow text-sm w-full bg-transparent"
                      :enabledCountryCode="true"
                      :defaultCountry="'TR'"
                      :disabledFetchingCountry="true"
                      @onSelect="onSelect"
                    ></vue-country-code>
                  </div>
                  <input
                    class="appearance-none text-blue-shadow text-sm flex-grow md:w-full py-3 px-4 border border-transparent"
                    type="text"
                    :placeholder="$t('call.phone-number')"
                    v-validate="'required|numeric'"
                    name="mobile"
                    v-model="call.mobile"
                  />
                </div>
                <div
                  class="text-red block"
                  v-if="errors.firstRule('mobile')!=='required'"
                >{{ errors.first('mobile') }}</div>
              </div>
              <div class="w-full px-6 sm:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  {{$t('call.message')}}
                  <!-- <span class="required">*</span> -->
                </label>
                <div
                  class="input-handler relative rounded-lg w-full flex items-center bg-white"
                  :class="{ 'has-danger': errors.has('message') }"
                >
                  <textarea
                    class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 border border-transparent"
                    :placeholder="$t('call.message')"
                    rows="8"
                    name="message"
                    v-model="call.message"
                  ></textarea>
                </div>
              </div>
              <div class="w-full px-6 sm:px-2 mb-6 text-center">
                <button
                  class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full"
                  type="submit"
                >{{$t('call.submit')}}</button>
              </div>
              <div class="w-full px-6 sm:px-2 mb-6 text-center">
                <div
                  :class="success===true?'':'hidden'"
                  class="bg-red-100 border border-green text-green px-4 py-3 rounded relative"
                  role="alert"
                >
                  <span class="block">{{$t('home.sent_successfully')}}</span>
                </div>
              </div>
            </div>
            <div class="w-1/2 sm:w-full pb-8">
              <GmapMap
                v-if="this.settings.Location"
                :center="{lat:parseFloat(this.settings.Location.latitude), lng:parseFloat(this.settings.Location.longitude)}"
                :zoom="15"
                id="map"
                style="width: 100%; height: 100%"
              >
                <GmapMarker
                  v-if="markers"
                  :key="'markers'+index"
                  v-for="(m, index) in markers"
                  :position="m.position"
                  :clickable="true"
                  :draggable="false"
                />
              </GmapMap>
            </div>
          </div>
        </form>
      </div>
    </div>
    <ContactUs />
  </div>
</template>
<script>
import axios from "~/plugins/axios.js";
import "vue-select/dist/vue-select.css";
import ContactUs from "~/components/contact-us";
import "vue-country-code/dist/vue-country-code.css";

export default {
  head() {
    return {
      title: this.$t("app.name") + " - " + this.title,
      meta: this.page.seo
    };
  },
  created() {
    const attrs = {
      messages: {},
      attributes: {
        name: "الاسم",
        email: "البريد الالكتروني",
        mobile: "رقم الجوال",
        message: "الرسالة"
      }
    };
    this.$validator.localize("ar", attrs);
  },
  data() {
    return {
      call: {
        mobile: "",
        code: "90",
        name: "",
        email: "",
        message: "",
        page: this.$route.path
      },
      success: false,
      error: false,
      errorMsgs: [],
      options: ["Male", "Female"],
      multi: ["select 1", "select 2"],
      value: [0, 1000]
    };
  },
  computed: {
    settings() {
      return this.$store.state.settings;
    },
    page() {
      return this.$store.state.page;
    },
    title() {
      return this.page ? this.page.title : this.$t("links.contact");
      // const item = this.page.seo.find((x=> {return x.name==='title'}));
      // return item ? item.content : this.$t('links.contact');
    },
    markers() {
      return [
        {
          position: {
            lat: parseFloat(this.$store.state.settings.Location.latitude),
            lng: parseFloat(this.$store.state.settings.Location.longitude)
          }
        }
      ];
    }
  },
  async asyncData({ store, error }) {
    let res = await Promise.all([
      store.dispatch("getCurrentPage", "contact_us"),
      store.dispatch("getPage", {
        lang: store.app.i18n._vm.locale,
        page: "contact-us"
      })
    ]);
  },
  mounted() {
    // window.main.init();
  },
  components: {
    ContactUs
  },
  methods: {
    validateBeforeSubmit(event) {
      this.$validator.resume();
      this.$validator.validate().then(result => {
        if (result) {
          //// eslint-disable-next-line
          axios
            .post("/api/call", this.call)
            .then(res => {
              this.success = true;
              const $this = this;
              setTimeout(function() {
                $this.call = {
                  mobile: null,
                  email: null,
                  code: "90"
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
              setTimeout(function() {
                $this.error = false;
              }, 3000);
            });
          return;
        }
      });
    },
    onSelect({ name, iso2, dialCode }) {
      this.call.code = dialCode;
    }
  }
};
</script>
<style lang="scss" scoped>
.has-danger input,
.has-danger textarea {
  border-color: #f33950 !important;
}
.forms-page {
  background-color: #f7f7f7;
}

.forms-img {
  img {
    object-fit: cover;
    height: 400px;
    @include respond-to(991px) {
      height: 400px;
    }
    @include respond-to(576px) {
      height: 300px;
    }
  }

  .form-title {
    box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.03);
  }

  .container-content {
    top: 70%;
    @include respond-to(576px) {
      top: 55%;
    }

    .contact-desc {
      @include respond-to(576px) {
        height: 130px;
        overflow: hidden;
      }
    }
  }
}

.forms-content {
  padding-top: 220px;
  @include respond-to(991px) {
    padding-top: 100px;
  }
}
</style>
<style lang="scss">
.pointer {
  input {
    cursor: pointer;
  }
}

.vue-map-container {
  @include respond-to(991px) {
    height: 400px !important;
  }
  @include respond-to(576px) {
    height: 400px !important;
  }
}
</style>
