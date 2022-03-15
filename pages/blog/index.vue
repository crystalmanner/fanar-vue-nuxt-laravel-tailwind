<template>
  <div class="padding-menu">
    <div class="blog-page">
      <div class="title-bar bg-dark-blue text-white py-8 text-center mb-16 md:mb-8">
        <h1 class="text-lg uppercase">{{$t('blogs.our_blog')}}</h1>
      </div>

      <div class="container-content">
        <div class="flex flex-wrap -mx-4">
          <div class="left-side px-4">
            <ul class="list-reset flex bg-white rounded-t-lg mb-8 tab-title">
              <li class="-mb-px ltr:mr-1 rtl:ml-1">
                <a
                  @click.prevent="selectTab(0)"
                  :class="selectedTab===0?'active':''"
                  class="inline-block text-blue-shadow px-4 py-6 no-underline uppercase"
                  href="#"
                >All</a>
              </li>
              <li class="ltr:mr-1 rtl:ml-1">
                <a
                  @click.prevent="selectTab(1)"
                  :class="selectedTab===1?'active':''"
                  class="inline-block p-4 text-blue-shadow py-6 no-underline uppercase"
                  href="#"
                >Blogs</a>
              </li>
              <li class="ltr:mr-1 rtl:ml-1">
                <a
                  @click.prevent="selectTab(2)"
                  :class="selectedTab===2?'active':''"
                  class="inline-block p-4 text-blue-shadow py-6 no-underline uppercase"
                  href="#"
                >News</a>
              </li>
            </ul>

            <div class="blog-tab-content">
              <div :class="selectedTab===0?'':'hidden'">
                <article
                  v-for="(item,index) in blogs"
                  :key="'blog'+index"
                  class="flex flex-wrap items-stretch justify-between bg-white rounded-lg overflow-hidden mb-8"
                  itemscope
                  itemtype="http://schema.org/NewsArticle"
                >
                  <div
                    class="w-2/5 xs:w-full"
                    itemprop="image"
                    itemscope
                    itemtype="http://schema.org/ImageObject"
                  >
                    <meta itemprop="height" content="200" />
                    <meta itemprop="width" content="200" />
                    <meta itemprop="url" :content="item.image" />
                    <n-link :to="localePath('blog')+'/'+item.slug">
                      <img class="w-full h-full" :src="item.image" />
                    </n-link>
                  </div>
                  <span itemprop="author" class="sr-only">الفنار العقارية</span>
                  <div
                    itemprop="publisher"
                    itemscope
                    itemtype="http://schema.org/Organization"
                    class="sr-only"
                  >
                    <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                      <meta itemprop="url" content="/img/fanar-logo.png" />
                      <img src="/img/fanar-logo.png" alt="ImageLogo" />
                    </div>
                    <span itemprop="name">الفنار العقارية</span>
                  </div>
                  <div class="w-3/5 xs:w-full card-body flex flex-col justify-between px-4 py-4">
                    <div class="offer-title pb-4">
                      <n-link
                        :to="localePath('blog')+'?type='+(item.type==='blog'?1:2)"
                        class="no-underline"
                      >
                        <span
                          class="rounded-full py-2 px-4 tag uppercase text-white text-xs font-bold"
                          :class="item.type==='blog'?'bg-dark-blue':'bg-brown-color'"
                        >{{item.type}}</span>
                      </n-link>
                      <h2 class="text-base font-bold mb-4 mt-6" itemprop="headline">
                        <n-link
                          :to="localePath('blog')+'/'+item.slug"
                          class="no-underline text-main-color"
                        >{{item.title}}</n-link>
                      </h2>
                      <p
                        class="text-xs font-bold text-blue-shadow mb-4"
                        itemprop="datePublished"
                        :content="item.created_at_meta"
                      >{{item.created_at}}</p>
                      <truncate
                        class="text-sm text-blue-shadow font-bold"
                        itemprop="description"
                        :length="400"
                        clamp
                        less
                        type="html"
                        :text="'<p>'+item.description+'</p>'"
                      ></truncate>
                      <div class="blog-tags mt-4 mb-2" v-if="item.keywords">
                        <span
                          v-for="(tag) in item.keywords"
                          :key="tag"
                          class="rounded-full no-underline py-2 px-4 tag text-main-color text-xs font-bold ltr:mr-1 rtl:ml-1"
                        >{{tag}}</span>
                      </div>
                    </div>
                    <!-- offer-title -->
                    <div class="more-details xs:text-center pt-4">
                      <n-link
                        :to="localePath('blog')+'/'+item.slug"
                        class="text-dark-blue font-bold text-sm no-underline"
                      >{{$t('blogs.read_more')}}</n-link>
                    </div>
                  </div>
                </article>
              </div>

              <div :class="selectedTab===1?'':'hidden'">
                <article
                  v-for="(item,index) in blogs"
                  :key="'blgs'+index"
                  v-if="item.type==='blog'"
                  class="flex flex-wrap items-stretch justify-between bg-white rounded-lg overflow-hidden mb-8"
                  itemscope
                  itemtype="http://schema.org/NewsArticle"
                >
                  <div
                    class="w-2/5 xs:w-full"
                    itemprop="image"
                    itemscope
                    itemtype="http://schema.org/ImageObject"
                  >
                    <meta itemprop="height" content="200" />
                    <meta itemprop="width" content="200" />
                    <meta itemprop="url" :content="item.image" />
                    <n-link :to="localePath('blog')+'/'+item.slug">
                      <img class="w-full h-full" :src="item.image" />
                    </n-link>
                  </div>
                  <span itemprop="author" class="sr-only">الفنار العقارية</span>
                  <div
                    itemprop="publisher"
                    itemscope
                    itemtype="http://schema.org/Organization"
                    class="sr-only"
                  >
                    <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                      <meta itemprop="url" content="/img/fanar-logo.png" />
                      <img src="/img/fanar-logo.png" alt="ImageLogo" />
                    </div>
                    <span itemprop="name">الفنار العقارية</span>
                  </div>
                  <div class="w-3/5 xs:w-full card-body flex flex-col justify-between px-4 py-4">
                    <div class="offer-title pb-4">
                      <n-link :to="localePath('blog')+'/'+item.slug" class="no-underline">
                        <span
                          class="rounded-full py-2 px-4 tag uppercase text-white text-xs font-bold bg-dark-blue"
                        >{{item.type}}</span>
                      </n-link>

                      <h3 class="text-base font-bold mb-4 mt-6" itemprop="headline">
                        <n-link
                          :to="localePath('blog')+'/'+item.slug"
                          class="no-underline text-main-color"
                        >{{item.title}}</n-link>
                      </h3>
                      <p
                        class="text-xs font-bold text-blue-shadow mb-4"
                        itemprop="datePublished"
                        :content="item.created_at_meta"
                      >{{item.created_at}}</p>
                      <truncate
                        class="text-sm text-blue-shadow font-bold"
                        itemprop="description"
                        :length="400"
                        clamp
                        less
                        type="html"
                        :text="'<p>'+item.description+'</p>'"
                      ></truncate>
                      <div class="blog-tags mt-4 mb-2" v-if="item.keywords">
                        <span
                          v-for="(tag) in item.keywords"
                          :key="tag"
                          class="rounded-full no-underline py-2 px-4 tag text-main-color text-xs font-bold ltr:mr-1 rtl:ml-1"
                        >{{tag}}</span>
                      </div>
                    </div>
                    <!-- offer-title -->

                    <div class="more-details xs:text-center pt-4">
                      <n-link
                        :to="localePath('blog')+'/'+item.slug"
                        class="text-dark-blue font-bold text-sm no-underline"
                      >{{$t('blogs.read_more')}}</n-link>
                    </div>
                  </div>
                </article>
              </div>

              <div :class="selectedTab===2?'':'hidden'">
                <article
                  v-for="(item,index) in blogs"
                  :key="'news'+index"
                  v-if="item.type==='news'"
                  class="flex flex-wrap items-stretch justify-between bg-white rounded-lg overflow-hidden mb-8"
                  itemscope
                  itemtype="http://schema.org/NewsArticle"
                >
                  <div
                    class="w-2/5 xs:w-full"
                    itemprop="image"
                    itemscope
                    itemtype="http://schema.org/ImageObject"
                  >
                    <meta itemprop="height" content="200" />
                    <meta itemprop="width" content="200" />
                    <meta itemprop="url" :content="item.image" />
                    <n-link :to="localePath('blog')+'/'+item.slug">
                      <img class="w-full h-full" :src="item.image" />
                    </n-link>
                  </div>
                  <span itemprop="author" class="sr-only">الفنار العقارية</span>
                  <div
                    itemprop="publisher"
                    itemscope
                    itemtype="http://schema.org/Organization"
                    class="sr-only"
                  >
                    <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                      <meta itemprop="url" content="/img/fanar-logo.png" />
                      <img src="/img/fanar-logo.png" alt="ImageLogo" />
                    </div>
                    <span itemprop="name">الفنار العقارية</span>
                  </div>
                  <div class="w-3/5 xs:w-full card-body flex flex-col justify-between px-4 py-4">
                    <div class="offer-title pb-4">
                      <n-link :to="localePath('blog')+'/'+item.slug" class="no-underline">
                        <span
                          class="rounded-full py-2 px-4 tag uppercase text-white text-xs font-bold bg-brown-color"
                        >{{item.type}}</span>
                      </n-link>
                      <h3 class="text-base font-bold mb-4 mt-6" itemprop="headline">
                        <n-link
                          :to="localePath('blog')+'/'+item.slug"
                          class="no-underline text-main-color"
                        >{{item.title}}</n-link>
                      </h3>
                      <p
                        class="text-xs font-bold text-blue-shadow mb-4"
                        itemprop="datePublished"
                        :content="item.created_at_meta"
                      >{{item.created_at}}</p>
                      <truncate
                        class="text-sm text-blue-shadow font-bold"
                        itemprop="description"
                        :length="400"
                        clamp
                        less
                        type="html"
                        :text="'<p>'+item.description+'</p>'"
                      ></truncate>
                      <div class="blog-tags mt-4 mb-2" v-if="item.keywords">
                        <span
                          v-for="(tag) in item.keywords"
                          :key="tag"
                          class="rounded-full no-underline py-2 px-4 tag text-main-color text-xs font-bold ltr:mr-1 rtl:ml-1"
                        >{{tag}}</span>
                      </div>
                    </div>
                    <!-- offer-title -->
                    <div class="more-details xs:text-center pt-4">
                      <n-link
                        :to="localePath('blog')+'/'+item.slug"
                        class="text-dark-blue font-bold text-sm no-underline"
                      >{{$t('blogs.read_more')}}</n-link>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>

          <aside class="right-side px-4 pb-8">
            <div class="features-side bg-white rounded-lg pt-6 pb-2 px-4" v-if="featured.length">
              <h3
                class="text-lg font-bold text-main-color pb-2 text-sm font-bold text-main-color -mx-4 px-4 aside-title"
              >{{$t('home.featured_offers')}}</h3>
              <div class="md-lg:flex md-lg:flex-wrap pt-8">
                <div
                  class="w-full md-lg:w-1/2 md-lg:px-4 mb-4"
                  v-for="(item,index) in featured"
                  :key="'all'+index"
                >
                  <n-link
                    :to="localePath('properties')+'/istanbul'+'/'+item.slug"
                    class="no-underline"
                  >
                    <div class="max-w-sm rounded-lg">
                      <div class="relative">
                        <img
                          class="w-full rounded-tr-lg rounded-tl-lg my-aside-img"
                          :src="item.image"
                          :alt="item.image_alt"
                          :title="item.image_title"
                        />
                        <div
                          class="offer-tag absolute pin-l pin-t text-white text-sm ltr:pl-4 rtl:pr-4 ltr:pr-3 rtl:pl-3 py-2"
                          :class="item.status.id===2?'red':'green'"
                          v-if="item.status"
                        >{{item.status.name}}</div>
                      </div>
                      <div class="card-body px-2 py-2 pb-3">
                        <div class="flex flex-wrap items-center justify-between mb-2">
                          <div class="price w-2/5 ltr:text-right rtl:text-left">
                            <p
                              class="line-through text-red-color text-xs font-bold rtl:text-right ltr:text-left mb-2"
                              v-if="item.price"
                            >
                              <ConvertPrice :price="formatPrice(item.price)" />
                              {{symbol}}
                            </p>
                            <p
                              class="text-dark-blue text-base font-bold rtl:text-right ltr:text-left"
                              v-if="item.price_after"
                            >
                              <ConvertPrice :price="formatPrice(item.price_after)" />
                              {{symbol}}
                            </p>
                          </div>
                          <p
                            class="text-blue-shadow w-3/5 text-sm rtl:text-left ltr:text-right"
                            v-if="item.municipality"
                          >
                            <span v-if="item.municipality.city">
                              <i class="fas fa-map-marker-alt text-brown-color"></i>
                              <span
                                v-if="item.municipality.city.name"
                              >{{item.municipality.city.name}}</span> -
                              <span v-if="item.municipality.name">{{item.municipality.name}}</span>
                            </span>
                          </p>
                        </div>

                        <div class="offer-title flex flex-wrap">
                          <div class="w-full">
                            <h3 class="text-lg mb-2 text-main-color font-bold">
                              <truncate :length="75" clamp less type="html" :text="item.name"></truncate>
                            </h3>
                          </div>
                        </div>
                        <!-- offer-title -->
                        <div
                          class="offer-info mt-1 flex items-center content-center justify-center border-solid border rounded"
                        >
                          <div class="beds w-1/3 py-1">
                            <div class="text-center">
                              <img
                                src="/img/bed.svg"
                                class="text-dark-blue bed-icon mb-1"
                                alt="bed icon"
                              />
                              <p class="text-main-color text-xs font-bold">
                                <span class="pr-1">{{item.bedrooms}}</span>
                                {{$t('home.bedrooms')}}
                              </p>
                            </div>
                          </div>
                          <div class="house w-1/3 py-1">
                            <div class="text-center">
                              <img src="/img/home.svg" class="mb-1 home-icon" alt="home icon" />
                              <p class="text-main-color text-xs font-bold">
                                <span class="pr-1">{{item.total_area}}</span>
                                {{$t('home.m')}}
                                <sup>2</sup>
                              </p>
                            </div>
                          </div>
                          <div class="bathroom w-1/3 py-1">
                            <div class="text-center">
                              <img
                                src="/img/bathroom.svg"
                                class="bath-icon mb-1"
                                alt="bathroom icon"
                              />
                              <p class="text-main-color text-xs font-bold">
                                <span class="pr-1">{{item.bathrooms}}</span>
                                {{$t('home.bathrooms')}}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </n-link>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
    <ContactUs />
  </div>
</template>

<script>
import truncate from "vue-truncate-collapsed";
import ConvertPrice from "~/components/ConvertPrice";
import ContactUs from "~/components/contact-us";

export default {
  head() {
    return {
      title: this.$t("app.name") + " - " + this.$t("links.blog"),
      meta: this.blog.seo
    };
  },
  data() {
    return {
      selectedTab: 0
    };
  },
  mounted() {
    // window.main.init();
    if (this.$route.query.type) {
      this.selectTab(parseInt(this.$route.query.type));
    }
  },
  methods: {
    selectTab(index) {
      this.selectedTab = index;
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  },
  components: {
    truncate,
    ConvertPrice,
    ContactUs
  },

  async asyncData({ store, error }) {
    let res = await Promise.all([
      store.dispatch("getBlogs", store.app.i18n._vm.locale),
      store.dispatch("getFeatured", store.app.i18n._vm.locale),
      store.dispatch("getCurrentPage", "articles"),
      store.dispatch("getPage", {
        lang: store.app.i18n._vm.locale,
        page: "blog"
      })
    ]);
  },

  computed: {
    blogs() {
      return this.$store.state.blogs;
    },
    featured() {
      return this.$store.state.featured;
    },
    symbol() {
      return this.$store.state.symbol;
    },
    blog() {
      return this.$store.state.page;
    },
    title() {
      return this.blog ? this.blog.title : this.$t("links.blog");
      // const item = this.blog.seo.find((x=> {return x.name==='title'}));
      // return item ? item.content : this.$t('links.real-estate');
    }
  }
};
</script>

<style lang="scss" scoped>
.blog-page {
  background-color: #f7f7f7;

  .aside-title {
    border-bottom: 1px solid #f7f7f7;
  }

  .tab-title li a.active {
    color: #3489d8;
    border-bottom: 3px solid #3489d8;
  }

  @include respond-to(576px) {
    h3 {
      font-size: 16px !important;
    }
  }

  .left-side {
    width: 66.66667%;
  }

  .right-side {
    width: 33.33333%;
  }

  .left-side,
  .right-side {
    @include respond-to(991px) {
      width: 100%;
    }
  }

  .more-details {
    border-top: 1px solid #f2f2f2;

    a:hover {
      color: #cea660;
    }
  }

  .blog-tab-content {
    img {
      object-fit: cover;
      height: 100%;
    }
  }

  .features-side {
    > img {
      @include respond-to-min-width(1600px) {
        height: 200px;
      }
      @include respond-to(1600px) {
        height: 150px;
      }
      object-fit: cover;
    }
  }

  html[dir="ltr"] .offer-info .beds,
  .offer-info .house {
    border-right: 1px solid #f0f0f0;
  }

  html[dir="rtl"] .offer-info .beds,
  .offer-info .house {
    border-left: 1px solid #f0f0f0;
  }
}

.offer-title {
  h3 {
    font-size: 16px;
    height: 44px;
    overflow: hidden;
    @include respond-to(991px) {
      width: 100%;
    }
  }
}
</style>
