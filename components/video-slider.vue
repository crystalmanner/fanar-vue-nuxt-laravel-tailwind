<template>
  <div class="video-library bg-white pb-16 xs:pb-2">
    <div class="container-content">
      <div class="title text-center pt-16 md:pt-8">
        <h2 class="text-dark-blue text-4xl font-bold" v-if="sectionTitle === 'name.ar'">{{settings.video_title_ar}}</h2>
        <h2 class="text-dark-blue text-4xl font-bold" v-else-if="sectionTitle === 'name.en'">{{settings.video_title_en}}</h2>
        <p class="text-blue-shadow w-1/2 mx-auto md:w-full" v-if="sectionTitle === 'name.ar'">{{settings.video_description_ar}}</p>
        <p class="text-blue-shadow w-1/2 mx-auto md:w-full" v-else-if="sectionTitle === 'name.ar'">{{settings.video_description_en}}</p>
      </div>
    </div>

    <div class="video-slider flex items-center">
      <div v-swiper:mySwiper="swiperOptions" class="gallery-thumbs swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide relative" v-for="(item,index) in videos" :key="index">
            <div class="video-handler" v-if="item.video_id">
              <a class="js-modal-btn cursor-pointer" :data-video-id="item.video_id">
                <div class="relative h-full w-full">
                  <div class="overlay absolute pin"></div>
                  <img class="w-full" :src="'https://i3.ytimg.com/vi/'+item.video_id+'/maxresdefault.jpg'" alt="">
                  <div class="absolute video-desc pin">
                    <div class="play-icon flex items-center justify-center rounded-full absolute">
                      <i class="fas fa-play text-white"></i>
                    </div>
                    <div class="video-text absolute pin-b pin-x p-4 xs:px-6">
                      <p class="text-white font-bold text-sm">{{item.title}}</p>
                      <p class="date text-xs mt-2">{{item.created_at}}</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
        <div class="swiper-pagination" slot="pagination"></div>
      </div>
    </div>
  </div>
</template>


<script>

  export default {
    data() {
      return {
        swiperOptions: {
          centeredSlides: true,
          spaceBetween: 0,
          slidesPerView: 3,
          touchRatio: 0.2,
          loop: true,
          slideToClickedSlide: true,
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 2
            },
            450: {
              slidesPerView: 1.25,
              spaceBetween: 2
            },
            576: {
              slidesPerView: 2,
              spaceBetween: 2,
            },
            1024: {
              slidesPerView: 2,
            }
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
        },
        sectionTitle: 'name.' + this.$store.app.i18n.locale,
      }
    },
    async asyncData({store, error}) {
      const $sectionTitle = 'name.' + store.app.i18n.locale;
    },
    components: {},
    methods: {},
    computed: {
      settings() {
        return this.$store.state.settings;
      },
      videos() {
        return this.$store.state.videos;
      },
      rtl() {
        return this.$store.app.i18n._vm.locale === 'ar' ? true : false
      },
    }
  }
</script>
<style lang="scss" scoped>

  .overlay {
    background-color: rgba(0, 0, 0, 0.5);
  }


  .video-handler {
    height: 375px;
    @include respond-to(991px){
      height: 255px;
    }
    @include respond-to(576px) {
      height: 250px;
    }

    img {
      height: 100%;
      object-fit: cover;

    }

  }

  .video-desc {
    opacity: 0;
  }

  .date {
    color: #c1ebff;
  }


</style>
<style lang="scss">
  .video-library {
    .swiper-slide-active {
      transform: scale(1.1);
      z-index: 8;


      img {
        border-radius: 10px;
      }

      .overlay {
        opacity: 0;
      }

      .video-desc {
        opacity: 1;

        .play-icon {
          width: 80px;
          height: 80px;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background: rgba(52, 137, 216, 0.8);
          @include respond-to(576px) {
            top: 40%;
            width: 60px;
            height: 60px;
          }

        }

        .video-text {
          background: rgba(26, 64, 102, 0.8);
          border-bottom-right-radius: 5px;
          border-bottom-left-radius: 5px;

        }
      }
    }

    .modal-video-close-btn {
      right: 0;
    }

    .swiper-container {
      padding: 50px 0;

    }

    .swiper-container-rtl {
      .swiper-button-next,
      .swiper-button-prev {
        width: 38px;
        height: 38px;
        background-color: rgba(52, 137, 216, .7) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;

        background: none;
        transform: scaleX(-1);
      }

      .swiper-button-prev {
        right: 0;
      }

      .swiper-button-next {
        left: 0;
        right: auto;
      }

    }

    .gallery-thumbs .swiper-slide {
      opacity: 1;
    }

    .swiper-button-prev {
      width: 38px;
      height: 38px;
      background-color: rgba(52, 137, 216, .7) !important;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      &:focus {
        outline: none;
      }

      background-image: none;
      left: 0;

      &:before {
        content: "\f060";
        font-weight: 900;
        font-family: "Font Awesome 5 Free";
        color: #fff;
        font-size: 18px;

        @include border-radius(50%);
      }
    }

    .swiper-button-next {
      width: 38px;
      height: 38px;
      background-color: rgba(52, 137, 216, .7) !important;
      right: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      @include border-radius(50%);
      background-image: none;

      &:focus {
        outline: none;
      }
      &:before {
        content: "\f061";
        font-weight: 900;
        font-family: "Font Awesome 5 Free";
        color: #fff;
        font-size: 18px;
      }
    }

    .swiper-button-next,
    .swiper-button-prev {
      @include respond-to(576px) {
        display: none;
      }
    }

    .swiper-pagination{
      display: none;
      @include respond-to(576px){
        display: block !important;
      }
    }
  }

</style>
