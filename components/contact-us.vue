<template>
  <div class="contact-handler">
    <div class="contact-btn">
      <div>
        <span class="text-white bg-dark-blue say-hi" @click="seen = !seen">
          <span v-if="seen" class="hide-mobile">
            <i class="fas fa-times"></i>
          </span>
          <span class="text-base font-bold hide-mobile" v-else>{{$t('call.hi')}}</span>
          <span>
            <i class="fas fa-comments show-mobile text-dark-blue text-xl"></i>
          </span>
        </span>
        <span class="lets-call hide-mobile">
          <span class="text-dark-blue text-sm font-bold">{{$t('call.hello')}},</span>
          <br />
          <span class="text-main-color text-xs font-bold">{{$t('call.call-you')}}</span>
        </span>
      </div>
      <transition name="fade">
        <div class="contact-box bg-white rounded-lg text-center flex items-center" v-if="seen">
          <div class="card w-full">
            <div class="card-header bg-dark-blue relative w-full text-center py-10 xs:py-6">
              <span class="close" @click="seen = !seen">
                <i class="fas fa-times"></i>
              </span>
              <img src="/img/avatar.png" alt />
            </div>
            <div class="card-body bg-white pt-12 pb-8 px-6 xs:pt-6 xs:pb-4">
              <p class="text-dark-blue text-sm">
                {{$t('call.leave-number')}}
                <span class="font-bold">{{$t('call.call-back')}}</span>
              </p>
              <form class="text-left mt-4" novalidate @submit.prevent="validateBeforeSubmit">
                <div class="mb-4">
                  <label class="block text-main-color text-xs font-bold mb-2" for="phone-number">
                    {{$t('call.phone-number')}}
                    <span class="required">*</span>
                  </label>
                  <div
                    class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                    :class="{ 'has-danger': errors.has('mobile') }"
                  >
                    <div class="input-number flex items-center w-2/6 xs:w-2/5">
                      <vue-country-code
                        class="text-blue-shadow text-sm w-full bg-transparent"
                        :enabledCountryCode="true"
                        :defaultCountry="'TR'"
                        :disabledFetchingCountry="true"
                        @onSelect="onSelect"
                      ></vue-country-code>
                      <!--                      <input class="text-blue-shadow text-sm w-full bg-transparent" readonly value="00970"-->
                      <!--                             placeholder="00970" v-model="call.code">-->
                    </div>
                    <input
                      class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-1 rtl:pr-1"
                      id="phone-number"
                      type="text"
                      :placeholder="$t('call.phone-number')"
                      v-validate="'required|numeric'"
                      name="mobile"
                      v-model="call.mobile"
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
                  >{{$t('call.your-name')}}</label>
                  <div class="input-handler relative border rounded-full w-full py-3 px-4 flex">
                    <input
                      class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                      type="text"
                      :placeholder="$t('call.your-name')"
                      v-model="call.name"
                    />
                  </div>
                </div>
                <div class="mb-4">
                  <label
                    class="block text-main-color text-xs font-bold mb-2"
                    for="phone-number"
                  >{{$t('call.your-email')}}</label>
                  <div
                    class="input-handler relative border rounded-full w-full py-3 px-4 flex"
                    :class="{ 'has-danger': errors.has('email') }"
                  >
                    <input
                      class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3"
                      type="text"
                      :placeholder="$t('call.your-email')"
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
                  >{{$t('call.submit')}}</button>
                </div>
                <div
                  :class="success===true?'':'hidden'"
                  class="bg-red-100 border border-green text-green px-4 py-3 rounded relative"
                  role="alert"
                >
                  <span class="block">Sent Successfully</span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </transition>
    </div>
    <a
      href="https://api.whatsapp.com/send?phone=905395919999"
      target="_blank"
      class="contact-btn rtl:pl-2 ltr:pr-2"
    >
      <span class="text-white bg-dark-blue say-hi cta">
        <span>
          <i class="fab fa-whatsapp text-2xl"></i>
        </span>
      </span>
    </a>
  </div>
</template>
<script>
import axios from "~/plugins/axios.js";
import "vue-country-code/dist/vue-country-code.css";

export default {
  data() {
    return {
      seen: false,
      call: {
        mobile: "",
        code: "",
        name: "",
        email: "",
        page: this.$route.path
      },
      success: false,
      error: false,
      errorMsgs: []
    };
  },
  mounted() {},
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
              // if (res.response.data.errors.email) {
              //   this.errorMsgs = res.response.data.errors.email[0];
              // }
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
#phone-number {
  width: 100%;
}

.hide-mobile {
  display: block;
  @include respond-to(576px) {
    display: none;
  }
}

.show-mobile {
  display: none;
  @include respond-to(576px) {
    display: block;
  }
}

.contact-handler {
  position: fixed;
  top: 80%;
  z-index: 20;
  @include respond-to(576px) {
    top: 88%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row-reverse;
  }

  .contact-box {
    position: absolute;
    top: -505px;
    z-index: 99;
    @include respond-to-min-width(576px) {
      overflow: hidden;
    }
    @include respond-to(576px) {
      position: fixed;
      right: 0;
      top: 0;
      bottom: 0;
      left: 0;
      width: 100%;
    }
  }
}

.has-danger {
  border-color: #f33950 !important;
}

html[dir="ltr"] .contact-box {
  right: 0;
}

html[dir="rtl"] .contact-box {
  left: 0;
}

html[dir="ltr"] .contact-handler {
  right: 10px;
}

html[dir="rtl"] .contact-handler {
  left: 10px;
}

.contact-box {
  width: 280px;
  box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.05);
  z-index: 8;

  .card-header {
    img {
      top: calc(50% + 15px);
      position: absolute;
      right: calc(50% - 26px);
      @include respond-to(576px) {
        top: calc(50% + -8px);
      }
    }

    @include respond-to(576px) {
      position: absolute;
      top: 0;
    }

    .close {
      display: none;
      @include respond-to(576px) {
        display: block;
        position: absolute;
        #{$opDir}: 10px;
        top: 35%;
        color: #fff;
      }
    }
  }
}

html[dir="ltr"] .contact-btn .say-hi {
  right: 0;

  &:after {
    right: 0;
  }
}

html[dir="rtl"] .contact-btn .say-hi {
  left: 0;

  &:after {
    right: 0;
  }
}

.contact-btn {
  cursor: pointer;

  .say-hi {
    border-radius: 5px 5px 0 5px;
    position: relative;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    @include respond-to(576px) {
      border-radius: 50%;
      background: #ffffff;
      @include box-shadow(0 0 2px 0 rgba(0, 0, 0, 0.7));
      &:after {
        display: none;
      }
    }

    &:after {
      content: "";
      position: absolute;
      bottom: -10px;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 0 10px 10px 0;
      border-color: transparent #3489d8 transparent transparent;
    }
  }

  .cta {
    border-radius: 50%;
    background: #ffffff;
    @include box-shadow(0 0 2px 0 rgba(0, 0, 0, 0.7));

    &:after {
      display: none;
    }

    i {
      color: #25d366;
    }
  }

  .lets-call {
    position: absolute;
    top: 5%;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

html[dir="ltr"] .lets-call {
  left: -80px;
}

html[dir="rtl"] .lets-call {
  right: -80px;
}
</style>
<style lang="scss">
.vue-country-select .dropdown-list {
  @include respond-to(576px) {
    width: 250px !important;
    #{$opDir}: 0 !important;
  }
}
</style>
