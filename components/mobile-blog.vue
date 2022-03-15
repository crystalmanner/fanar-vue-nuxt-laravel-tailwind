<template>
  <div class="container-content mobile-blog">
    <div class="flex flex-wrap">
      <div v-swiper:mySwiper="swiperOptions" class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide relative" v-for="(item,index) in blogs" :key="index">
            <div class="px-2">
              <div class="max-w-sm rounded-lg overflow-hidden">
                <n-link :to="localePath('blog')+'/'+item.slug">
                  <img class="w-full" :src="item.image" :alt="item.image_alt" :title="item.image_title" itemprop="image">
                </n-link>
                <div class="card-body px-4 py-2 bg-white">
                  <div class="offer-title pb-2 ">
                    <n-link :to="localePath('blog')+'/'+item.slug" class="no-underline">
                    <span class="rounded-full py-2 px-4 tag uppercase text-white text-xs font-bold"
                          :class="item.type==='blog'?'bg-dark-blue':'bg-brown-color'">{{item.type}}</span>
                    </n-link>
                    <h3 class="text-lg mb-2 mt-4">
                      <a href="#" class="no-underline text-main-color font-bold">{{item.title}}</a>
                    </h3>
                    <p class="text-xs text-main-color mb-2">{{item.created_at}}</p>
                      <truncate class="text-sm text-blue-shadow font-bold leading-normal" itemprop="description"
                                :length="60" clamp=""
                                less="" type="html"
                                :text="'<p>'+item.description+'</p>'"></truncate>
                  </div><!-- offer-title -->
                  <div class="more-details text-center pt-2">
                    <n-link :to="localePath('blog')+'/'+item.slug"
                            class="text-dark-blue font-bold text-sm no-underline">
                      {{$t('blogs.read_more')}}
                    </n-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import truncate from 'vue-truncate-collapsed';

  export default {
    data() {
      return {
        swiperOptions: {
          centeredSlides: true,
          spaceBetween: 0,
          slidesPerView: 1.125,
          touchRatio: 0.2,
          loop: true,
          breakpoints: {
            320:{
              slidesPerView: 1,
              spaceBetween: 2
            },
            420:{
              slidesPerView: 1.25,
              spaceBetween: 2
            },
            576: {
              slidesPerView: 1.5,
              spaceBetween: 2
            },
            767:{
              slidesPerView: 2.125,
              spaceBetween: 0,
            },
            991:{
              slidesPerView: 3,
              spaceBetween: 0,
            }
          },
        }
      }
    },

    components: {
      truncate
    },
    async asyncData({store, error}) {
      let res = await Promise.all([
        store.dispatch('getBlogs', store.app.i18n._vm.locale),
      ]);
    },
    computed: {
      blogs() {
        return this.$store.state.blogs;
      },
    }
  }
</script>

<style lang="scss">
  .mobile-blog {
    @include respond-to-min-width(991px) {
      display: none;
    }

    h3 {
      font-size: 16px !important;
    }
  }
</style>
