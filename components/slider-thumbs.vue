<template>
  <div>
    <div v-swiper:mySwiper="swiperOptionThumbs" class="gallery-thumbs swiper-container" ref="swiperThumbs" :rtl="rtl">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-bind:class="'slide-'+index" v-for="(item,index) in feature.images" :key="index">
          <img class="w-full custom-img" :src="item.file" :title="item.title" :alt="feature.image_alt"  v-if="!item.is_video">
          <div class="w-full custom-img" v-if="item.is_video===true">
            <img class="w-full custom-img" :src="'https://img.youtube.com/vi/'+item.file+'/sddefault.jpg'">
          </div>
        </div>
      </div>

    </div>
  </div>

</template>
<script>
  export default {
    data() {
      return {
        swiperOptionThumbs: {
          spaceBetween: 2,
          centeredSlides: true,
          slidesPerView: 'auto',
          touchRatio: 0.2,
          slideToClickedSlide: true,
          loopedSlides: 5,
          breakpoints: {
            330: {
              slidesPerView: 2,
              spaceBetween: 2
            },
            576: {
              slidesPerView: 3,
              spaceBetween: 2
            },
          },
        }
      }
    },
    async asyncData({store, error, params}) {
      const data = {
        lang: store.app.i18n._vm.locale,
        slug: params.slug
      };
      let [res] = await Promise.all([
        store.dispatch('getFeature', data),
        store.dispatch('getFeatured', store.app.i18n._vm.locale),
      ]);
    },
    computed: {
      feature() {
        return this.$store.state.feature;
      },
      rtl() {
        return this.$store.app.i18n._vm.locale === 'ar' ? true : false
      },
    }
  }
</script>
<style lang="scss" scoped>
  .custom-img {
    height: 125px;
    object-fit: cover;
    @include respond-to(991px) {
      height: 100px;
    }
    @include respond-to(767px) {
      height: 80px;
    }
  }
  .gallery-thumbs .swiper-slide{
    opacity: 1;
  }
</style>
