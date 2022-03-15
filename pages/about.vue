<template>
  <div class="padding-menu">
    <div class="about-page">
      <div class="title-bar bg-dark-blue text-white py-8 text-center mb-16 md:mb-8">
        <h1 class="text-lg uppercase">{{title}}</h1>
      </div>

      <div class="about-intro pb-24 md:pb-10" v-if="content">
        <div class="container-content">
          <div class="flex flex-wrap items-center justify-between" v-if="content.about_fanar">
            <div class="w-2/5 xs:w-full">
              <h2 class="text-brown-color font-medium text-5xl mb-8 w-1/3 leading-none md:w-full md:mb-6 section-title">
                {{content.about_fanar.title}}</h2>
              <div class="editor-text" v-html="content.about_fanar.description"></div>
            </div>

            <div class="w-1/2 xs:w-full">
              <img class="w-full rounded-lg" v-if="content.about_fanar.image" :src="content.about_fanar.image"
                   alt="Sunset in the mountains">
            </div>
          </div>
        </div>
      </div>

      <div class="our-history pb-24 md:pb-10" v-if="content">
        <div class="container-content" v-if="content.history">
          <div class="w-1/2 md:w-full">
            <h2 class="text-brown-color font-medium text-5xl mb-8 w-5/6 leading-none md:w-full section-title">
              {{content.history.title}}
            </h2>
          </div>
          <div class="editor-text" v-html="content.history.description"></div>
        </div>
      </div>

      <div class="why-us pb-24 md:pb-10" v-if="content">
        <div class="container-content">
          <div class="flex flex-wrap items-stretch justify-between" v-if="content.why_us">
            <div class="w-1/4 md:w-full md:mb-8" v-if="content.why_us.image">
              <img class="w-full h-full rounded-lg" :src="content.why_us.image"
                   alt="Sunset in the mountains">
            </div>
            <div class="md:w-full md:ltr:pl-0 md:rtl:pr-0"
                 :class="content.why_us.image ?'w-3/4 ltr:pl-12 rtl:pr-12 ':'w-full ltr:pl-0 rtl:pr-0'">
              <h2 class="text-dark-blue font-bold text-5xl mb-8 leading-none md:mb-4 section-title">{{content.why_us.title}}</h2>
              <div class="editor-text custom pb-4" v-html="content.why_us.description">
              </div>
              <n-link :to="localePath('contact-us')"
                      class="text-white font-bold text-sm custom-button py-3 px-10 mt-4 rounded-full  md:mx-auto no-underline">
                {{$t('call.call_us')}}
              </n-link>
            </div>
          </div>
        </div>
      </div>

      <div class="our-messages pb-10">
        <div class="container-content">
          <div class="flex flex-wrap -mx-4">
            <div v-if="content" class="w-1/2 px-4 xs:w-full xs:mb-6">
              <div class="our-text-box bg-white rounded-lg p-12 xs:p-8" v-if="content.vision">
                <h2 class="text-3xl text-brown-color font-medium mb-6 ltr:-ml-4 rtl:-mr-4 section-title">
                  {{content.vision.title}}</h2>
                <div v-html="content.vision.description" class="custom-list list-reset"></div>
              </div>
            </div><!--content-->
            <div v-if="content" class="w-1/2 px-4 xs:w-full xs:mb-6">
              <div class="our-text-box bg-white rounded-lg p-12 xs:p-8" v-if="content.message">
                <h2 class="text-3xl text-brown-color font-medium mb-6 ltr:-ml-4 rtl:-mr-4 section-title">
                  {{content.message.title}}</h2>
                <div v-html="content.message.description" class="custom-list list-reset"></div>
              </div>
            </div><!--content-->
            <div v-if="content" class="w-full px-4 mt-8 xs:w-full xs:mb-4 xs:mt-0">
              <div class="our-text-box bg-white rounded-lg p-12 xs:p-8" v-if="content.ethics">
                <h2 class="text-3xl text-brown-color font-medium mb-6 ltr:-ml-4 rtl:-mr-4 section-title">
                  {{content.ethics.title}}</h2>
                <div v-html="content.ethics.description" class="custom-list list-reset"></div>
              </div>
            </div><!--content-->
          </div><!--flex-->
        </div><!--container content-->
      </div><!--our messages-->

    </div>
    <ContactUs/>
  </div>
</template>
<script>
    import ContactUs from '~/components/contact-us'

    export default {
        head() {
            return {
                title: this.$t('app.name') + ' - ' + this.title,
                meta: this.about.seo
            }
        },
        async asyncData({store, error}) {
            let res = await Promise.all([
                store.dispatch('getPage', {lang: store.app.i18n._vm.locale, page: 'about'}),
                store.dispatch('getCurrentPage', 'about_us'),
            ]);
        },
        computed: {
            about() {
                return this.$store.state.page;
            },
            // firstSection() {
            //     return _.slice(this.about.sections, 0, 1);
            // },
            // secondSection() {
            //     return _.slice(this.about.sections, 1, 2);
            // },
            // thirdSection() {
            //     return _.slice(this.about.sections, 2, 3);
            // },
            // lastThree() {
            //     return _.slice(this.about.sections, 3, 6);
            // },
            title() {
                return this.about ? this.about.title : this.$t('links.about');
                // const item = this.about.seo.find((x=> {return x.name==='title'}));
                // return item ? item.content : this.$t('links.about');
            },
            content() {
                return this.about.content;
            },
        },
        mounted() {
            // window.main.init();
        },
        components: {
            ContactUs
        }
    }
</script>
<style lang="scss">
  .about-page {
    background: #f7f7f7;

    img {
      object-fit: cover;
    }

    .our-text-box {
      box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.03);

    }

    p {
      @include respond-to(991px) {
        font-size: 16px;
      }
    }

    .editor-text {
      h1, h2, h3, h4, h5, h6 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1a4066;
        margin: 1.5rem 0;
        @include respond-to(991px) {
          font-size: 18px !important;
          line-height: 1.3;
        }
      }

      p {
        color: #5b8da6;
        font-size: 18px;
        font-weight: bold;
        line-height: 1.3;
        margin: 1.5rem 0 0;
        @include respond-to(576px) {
          margin-bottom: 15px;
          font-size: 14px;

        }
      }

      ul {
        list-style: none;

        li {
          position: relative;
          font-size: 18px;
          font-weight: 500;
          margin-bottom: 20px;
          color: #1a4066;
          line-height: 1.5;

          &:before {
            content: '';
            position: absolute;
            top: 5px;
            width: 10px;
            height: 10px;
            @include border-radius(50%);
            background: #3489d8;

          }
        }
      }

      &.custom {
        p {
          margin-bottom: 34px;
        }
      }
    }

    .custom-list {
      ul {
        li {
          font-size: 16px;
          font-weight: 500;
          margin-bottom: 20px;
          color: #1a4066;
          line-height: 1.5;
        }
      }
    }

  }

  html[dir='ltr'] .editor-text ul {
    padding-left: 20px;
    @include respond-to(767px) {
      padding-left: 18px;
    }
  }

  html[dir='rtl'] .editor-text ul {
    padding-left: 20px;
    @include respond-to(767px) {
      padding-right: 18px;
    }
  }

  html[dir='ltr'] .editor-text ul li:before {
    left: -20px;
  }

  html[dir='rtl'] .editor-text ul li:before {
    right: -20px;
  }

  .section-title {
    @include respond-to(767px) {
      font-size: 26px !important;
    }
  }

</style>
