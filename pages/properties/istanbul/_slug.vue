<template>
  <div class="padding-menu">
    <div class="estate-title bg-white border-t">
      <div class="container-content">
        <div class="flex flex-wrap items-stretch" itemscope itemtype="http://schema.org/Product">
          <img :src="feature.image" itemprop="image" class="hidden" alt="image"/>
          <p itemprop="description" class="hidden">{{description}}</p>
          <span itemprop="brand" class="sr-only">Al Fanar</span>
          <div class="estate-title w-1/2 py-3 md:py-4 md:w-full">
            <p class="text-blue-shadow text-sm mb-2" v-if="feature.municipality">
              <i class="fas fa-map-marker-alt text-brown-color"></i>
              {{feature.municipality.city.name}} - {{feature.municipality.name}}
            </p>
            <h1 class="text-2xl text-main-color font-bold sm:text-base mb-2" itemprop="name">
              {{feature.name}}
            </h1>
            <p class="text-main-color text-xs font-bold" v-if="feature.deadline"><span
              class="text-blue-shadow">{{$t('real_estate.end_date')}}:</span>
              {{feature.deadline}} , <span class="text-main-color text-xs font-bold"><span class="text-blue-shadow">{{$t('real_estate.property_id')}}</span> {{feature.code}} </span>
            </p>
          </div>
          <div class="estate-desc w-1/2 md:w-full">
            <div class="offer-info flex items-stretch h-full content-center sm:-mx-4 border-t">
              <div
                class="beds w-1/4 flex items-center justify-center  ltr:border-l rtl:border-r md:lrt:border-l-0 md:rtl:border-r-0  sm:p-2">
                <div class="text-center">
                  <img src="/img/bed.svg" class="text-dark-blue bed-icon mb-2" alt="bed icon">
                  <p class="text-main-color text-xs font-bold"><span
                    class="ltr:pr-1 rtl:pl-1">{{feature.bedrooms}}</span>{{$t('home.bedrooms')}}</p>
                </div>
              </div>
              <div class="house w-1/4 flex items-center justify-center  sm:p-2">
                <div class="text-center">
                  <img src="/img/home.svg" class="mb-2 home-icon" alt="home icon">
                  <p class="text-main-color text-xs font-bold"><span
                    class="ltr:pr-1 rtl:pl-1">{{feature.total_area}}</span>{{$t('home.m')}}<sup>2</sup>
                  </p>
                </div>
              </div>
              <div class="bathroom w-1/4 flex items-center justify-center ltr:border-r rtl:border-l sm:p-2">
                <div class="text-center">
                  <img src="/img/bathroom.svg" class="bath-icon mb-2" alt="bathroom icon">
                  <p class="text-main-color text-xs font-bold"><span
                    class="ltr:pr-1 rtl:pl-1">{{feature.bathrooms}}</span>{{$t('home.bathrooms')}}</p>
                </div>
              </div>
              <div
                class="w-1/3 flex items-center justify-center ltr:border-r rtl:border-l ltr:md:border-r-0 rtl:border-l-0 sm:p-2">
                <div>
                  <p class="line-through text-blue-shadow text-xs font-bold xs:text-xxs" v-if="feature.price">
                    <ConvertPrice :price="formatPrice(feature.price)"/>
                    {{symbol}}
                  </p>
                  <p class="text-main-color font-medium text-xl font-bold sm:text-xs mb-1" v-if="feature.price_after">
                    <ConvertPrice :price="formatPrice(feature.price_after)"/>
                    {{symbol}}
                  </p>
                  <p class="text-main-color text-sm sm:text-xs xs:hidden" v-if="feature.meter_price"><span
                    class="text-blue-shadow">{{$t('real_estate.meter_price')}}:</span>
                    <ConvertPrice :price="formatPrice(feature.meter_price)"/>
                    {{symbol}}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="estate-details-page py-12 sm:py-4">
      <div class="container-content">
        <div class="flex flex-wrap -mx-4">
          <div class="left-side px-4">
            <div class="mb-4 bg-white rounded-lg px-6 py-4 shadow xs:px-4" v-if="feature.images.length">
              <no-ssr>
                <div class="fotorama slider mb-2" id="lightgallery" data-nav="thumbs" data-transition="crossfade"
                     data-autoplay="false" data-clicktransition="crossfade">
                  <a v-bind:class="'slide-'+index" v-for="(item,index) in feature.images" :key="index"
                     v-if="!item.is_video">
                    <img class="w-full custom-img" :src="item.file" :title="item.title" :alt="feature.image_alt"
                         itemprop="image">
                                        
                  </a>
                  <a v-else :href="'https://youtube.com/watch?v='+item.file"
                     :data-img="'https://img.youtube.com/vi/'+item.file+'/sddefault.jpg'">
                    <img :src="'https://img.youtube.com/vi/'+item.file+'/sddefault.jpg'">
                  </a>
                </div>
              </no-ssr>
            </div>

            <div></div>

            <div class="mb-4 bg-white rounded-lg px-6 py-4 shadow xxs:px-2">
              <div class="description border-b pb-12 sm:pb-4" v-if="feature.description">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">
                  {{$t('real_estate.description')}}</h3>
                <p
                  class="text-main-color text-lg font-medium leading-normal sm:text-sm sm:text-sm sm:leading-normal sm:font-medium"
                  itemprop="description">
                  {{feature.description}}</p>
              </div>


              <div class="payment-method border-b py-8" v-if="feature.payment_type">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.payment_method')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm">
                  {{feature.payment_type.name}}</p>
                <div class="flex items-center flex-wrap mt-3 w-3/4 bg-main-color text-white rounded-lg sm:w-full"
                     v-if="feature.payment_type.name==='Installments'|| feature.payment_type.name==='تقسيط'">
                  <div class="w-1/2 p-4 ltr:border-r rtl:border-l xxs:p-2">
                    <p class="text-xs font-bold mb-2">{{$t('real_estate.first_payment')}}</p>
                    <p class="text-base sm:text-sm" v-if="feature.down_payment_percent">
                      {{feature.down_payment_percent}}% <span class="font-bold sm:font-medium"
                                                              v-if="feature.down_payment_value"> -
                      <ConvertPrice :price="formatPrice(feature.down_payment_value)"/>
                      {{symbol}}
                    </span></p>
                  </div>
                  <div class="w-1/2 p-4 xxs:p-2">
                    <p class="text-xs font-bold mb-2">{{$t('real_estate.monthly_payment')}}</p>
                    <p class="text-base sm:text-sm">
                      <span class="font-bold sm:font-medium" dir="ltr" v-if="feature.installments_value">
                        <ConvertPrice :price="formatPrice(feature.installments_value)"/>
                        {{symbol}}
                      </span>
                      <span v-if="feature.installments_period">
                        <span dir="ltr">&nbsp X &nbsp</span>
                        <span dir="ltr">{{feature.installments_period}}</span>
                        {{$t('real_estate.month')}}
                     </span>
                    </p>
                  </div>
                </div>
              </div>


              <div class="return-investment py-4 border-b" v-if="feature.investment_return">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.return_on_investment')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm mb-2">{{feature.investment_return.name}}</p>
                <p class="text-main-color text-base font-bold sm:text-sm" v-if="feature.return_investment_value">
                  {{feature.return_investment_value}}
                  <!--                  <ConvertPrice :price="formatPrice(feature.return_investment_value)"/>-->
                  <!--                  {{symbol}}-->
                </p>
              </div>

              <div class="property-category border-b py-8"
                   v-if="feature.living_rooms && feature.bedrooms && feature.bathrooms && feature.kitchen_type || feature.balacony && feature.floor && feature.apartment_number">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.property_category')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm">{{$t('real_estate.apartment')}}</p>
                <div class="flex items-center flex-wrap mt-3 bg-main-color text-white rounded-lg">
                  <div class="w-1/2 p-4 sm:w-full xxs:p-2"
                       v-if="feature.floor || feature.apartment_number">
                    <p class="text-base sm:text-sm font-bold mb-2">{{$t('real_estate.floor&number')}}</p>
                    <p class="text-base sm:text-sm">
                      <span v-if="feature.floor">
                        {{feature.floor}} {{$t('real_estate.floor')}}
                      </span>
                      <span
                        v-if="feature.apartment_number">
                        - {{$t('real_estate.number')}} {{feature.apartment_number}}
                      </span>
                    </p>
                  </div>
                  <div class="w-full p-4 sm:w-full xxs:p-2 sm:border-t" v-if="feature.net_area">
                    <p class="text-base sm:text-sm font-bold mb-2">{{$t('real_estate.net_area')}}</p>
                    <ul class="text-base sm:text-sm list-reset flex flex-wrap">
                      <li class="w-1/3 sm:w-1/2 xs:w-full mb-2">{{$t('home.net_area')}}: ({{feature.net_area}}
                        {{$t('home.m2')}})
                      </li>
                      <li class="w-1/3 sm:w-1/2 xs:w-full mb-2">{{$t('home.total_area')}}: ({{feature.total_area}}
                        {{$t('home.m2')}} )
                      </li>
                      <li class="w-1/3 sm:w-1/2 xs:w-full mb-2" v-if="feature.bloc_number">
                        {{$t('real_estate.block')}} : {{feature.bloc_number}}
                      </li>
                    </ul>
                  </div>
                  <div class="w-full border-t p-4 sm:w-full xxs:p-2"
                       v-if="feature.living_rooms || feature.bedrooms || feature.bathrooms || feature.kitchen_type || feature.balacony">
                    <p class="text-base sm:text-sm font-bold mb-2">{{$t('real_estate.rooms')}}</p>
                    <ul class="flex flex-wrap list-reset">
                      <li class="w-1/3 sm:w-1/2 text-base sm:text-sm mb-2" v-if="feature.living_rooms">
                        {{$t('real_estate.livingroom')}} : {{feature.living_rooms}}
                      </li>
                      <li class="w-1/3 sm:w-1/2 text-base sm:text-sm mb-2" v-if="feature.bedrooms">
                        {{$t('home.bedrooms')}} : {{feature.bedrooms}}
                      </li>
                      <li class="w-1/3 sm:w-1/2 text-base sm:text-sm mb-2" v-if="feature.bathrooms">
                        {{$t('home.bathrooms')}} : {{feature.bathrooms}}
                      </li>
                      <li class="w-1/3 sm:w-1/2 text-base sm:text-sm mb-2" v-if="feature.kitchen_type">
                        {{$t('real_estate.kitchen')}} : {{feature.kitchen_type}}
                      </li>
                      <li class="w-1/3 sm:w-1/2 text-base sm:text-sm mb-2" v-if="feature.balacony">
                        {{$t('real_estate.balcony')}} : {{feature.balacony}}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="direction py-4 border-b" v-if="feature.directions.length">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.direction')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm">
                  <span v-if="feature.directions">
                    {{ feature.directions.join(" / ") }}
                  </span>
                  <span v-if="feature.views.length">-</span>
                  <span v-for="(item,index) in feature.views" :key="'view'+index" v-if="feature.views.length">
                    {{item.name }}
                  </span>
                </p>
              </div>

              <div class="floors py-4 border-b" v-if="feature.floors">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.number_of_floors')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm">{{feature.floors}}
                  {{$t('real_estate.floors')}}</p>
              </div>

              <div class="stuff py-4" v-if="feature.deliverables.length">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.stuff_included')}}</h3>
                <ul class="list-reset flex flex-wrap">
                  <li class="w-1/4 sm:w-1/3 xs:w-1/2 text-main-color text-lg font-bold sm:text-sm  mb-2"
                      v-for="(item,index) in feature.deliverables"
                      :key="'deliver'+index">{{item.name}}
                  </li>
                </ul>

              </div>

            </div>


            <div class="mt-6 mb-4 bg-white rounded-lg px-6 py-4 shadow">
              <div class="py-4 border-b">
                <p class="text-sm text-main-color font-bold"><i
                  class="fas fa-map-marker-alt text-brown-color ltr:pr-4 rtl:pl-4 text-lg"></i>
                  {{$t('real_estate.location_information')}}</p>
              </div>

              <div class="py-4 border-b">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.location')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm mb-2" v-if="feature.municipality">
                  <i class="fas fa-map-marker-alt text-brown-color"></i>
                  {{feature.municipality.city.name}} - {{feature.municipality.name}}
                </p>
                <p class="text-main-color text-lg" v-if="feature.downtown_distance">
                  {{feature.downtown_distance}} {{$t('real_estate.away_from_the_downtown_istanbul')}}
                </p>
              </div>

              <div class="py-4 border-b" v-if="feature.transports.length">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.transportation')}}</h3>
                <ul class="flex flex-wrap list-reset">
                  <li class="text-main-color text-lg font-bold sm:text-sm mb-2 w-1/4 sm:w-1/3 xs:w-1/2"
                      v-for="(item,index) in feature.transports" :key="'transport'+index">{{item.name}}
                  </li>
                </ul>
              </div>

              <!--              <div class="py-4" v-if="feature.landmarks || feature.landmarks.length">-->
              <!--                <div v-if="feature.landmarks.Marketing">-->
              <!--                  <div v-for="(item,i) in feature.landmarks.Marketing" :key="i">-->
              <!--                    <h3 class="text-sm text-blue-shadow font-bold mb-1" v-if="item.landmark_type.name.en">-->
              <!--                      {{item.landmark_type.name.en}}</h3>-->
              <!--                    <span v-if="item.name.en">{{item.name.en}}</span>-->
              <!--                  </div>-->
              <!--                </div>-->
              <!--              </div>-->

              <!--              <div class="py-4" v-if="feature.project && feature.project.landmarks">-->
              <!--                <div v-for="(item,land) in feature.project.landmarks" :key="land">-->
              <!--                  <h3 class="text-sm text-blue-shadow font-bold mb-1">{{land}}</h3>-->
              <!--                </div>-->
              <!--              </div>-->

            </div>


            <div class="mt-6 mb-4 bg-white rounded-lg px-6 py-4 shadow" v-if="feature.project">
              <div class="py-4 border-b">
                <p class="text-sm text-main-color font-bold">
                  <i
                    class="fas fa-building text-brown-color ltr:pr-4 rtl:pl-4 text-lg"></i>
                  {{$t('real_estate.project_information')}}</p>
              </div>

              <div class="py-4 border-b" v-if="feature.project.name">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.project_name')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm mb-2">{{feature.project.name}}</p>
              </div>

              <div class="py-4 border-b" v-if="feature.project.code">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.project_number')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm">{{feature.project.code}}</p>
              </div>

              <div class="py-4 border-b">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">{{$t('real_estate.project_status')}}</h3>
                <div class="flex flex-wrap mt-2">
                  <p class="text-main-color text-lg font-bold sm:text-sm sm:w-full sm:mb-2 ltr:pr-8 rtl:pl-8"
                     v-if="feature.status">{{feature.status.name}}</p>
                  <p class="text-main-color text-lg font-bold sm:text-sm sm:ltr:pl-3 sm:rtl:pr-3"
                     v-if="feature.project.delivery_date">{{feature.project.delivery_date}}</p>
                </div>
              </div>

              <div class="py-4 border-b" v-if="feature.project.apartments || feature.project.building">
                <h3 class="text-sm text-blue-shadow font-bold mb-1">
                  {{$t('real_estate.number_buildings_apartments')}}</h3>
                <p class="text-main-color text-lg font-bold sm:text-sm"><span v-if="feature.project.building">{{feature.project.building}} {{$t('real_estate.buildings')}}</span>
                  <span v-if="feature.project.apartments">{{feature.project.apartments}} {{$t('real_estate.apartments')}}</span>
                </p>
              </div>

              <div class="py-4" v-if="feature.project.facilities.length">
                <h3 class="text-sm text-blue-shadow font-bold mb-2">{{$t('real_estate.project_services')}}</h3>
                <ul class="list-reset ltr:pl-6 rtl:pr-6 custom-list xs:ltr:pl-4 xs:rtl:pr-4">
                  <li class="text-main-color text-lg mb-2" v-for="(item,index) in feature.project.facilities"
                      :key="'faci'+index">{{item.name}}
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <aside class="right-side px-4">
            <div class="md-lg:flex md-lg:flex-wrap md-lg:items-stretch">
              <div
                class="contact-box bg-white rounded-lg text-center  flex items-center shadow mb-6 md-lg:w-1/2 md-lg:px-4">
                <div class="card w-full">
                  <div class="card-body bg-white py-8 px-6">
                    <p class="text-dark-blue text-sm">{{$t('home.leave_your_contact_information')}} <br>
                      <span class="font-bold">{{$t('home.and_we_will_get_back_to_you')}}</span></p>
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
                          <input class="appearance-none text-blue-shadow text-sm flex-grow ltr:pl-3 rtl:pr-3 w-full"
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
                      <div class="flex items-center justify-center mt-6">
                        <button class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full"
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
              <div class="aside-img mb-6 md-lg:w-1/2 md-lg:px-4">
                <a :href="settings.apartments_promotion_link?settings.apartments_promotion_link:'/'">
                  <img class="w-full h-56 rounded-lg"
                       :src="settings.apartments_promotion_image?settings.apartments_promotion_image:'/img/aside-img.png'"
                       alt="Sunset in the mountains">
                </a>
              </div>
            </div>
            <div class="features-side bg-white rounded-lg pt-6 pb-2 px-4 mb-6" v-if="feature.related.length">
              <h3 class="text-sm font-bold text-main-color pb-4 -mx-4 px-4 aside-title">
                {{$t('real_estate.related_real_estate')}}</h3>
              <div class="md-lg:flex md-lg:flex-wrap pt-8">
                <div class="w-full md-lg:w-1/2 md-lg:px-4 mb-4" v-for="(item,index) in feature.related"
                     :key="'real'+index">
                  <div class="max-w-sm rounded-lg">
                    <div class="relative">
                      <img class="w-full rounded-tr-lg rounded-tl-lg" :src="item.image" :alt="item.image_alt"
                           :title="item.image_title">
                      <div
                        class="offer-tag absolute pin-l pin-t text-white text-sm ltr:pl-4 rtl:pr-4 ltr:pr-3 rtl:pl-3 py-2"
                        v-if="item.status" :style="'background-color:' + item.status.color">
                        {{item.status.name}}
                      </div>
                    </div>
                    <div class="card-body px-4 py-4">
                      <div class="offer-title mb-2">
                        <p class="text-blue-shadow text-xs mb-2" v-if="item.municipality">
                     <span>
                        <i class="fas fa-map-marker-alt text-brown-color"></i>
                        {{item.municipality.city.name}} <span> - {{item.municipality.name}}</span>
                     </span>
                        </p>
                        <div class="flex flex-wrap items-center justify-between">
                          <h3 class="text-lg font-bold mb-4 w-3/5">
                            <n-link :to="localePath('real-estate')+'/'+item.slug"
                                    class="no-underline text-main-color text-sm">
                              <truncate
                                :length="40" clamp=""
                                less="" type="html"
                                :text="item.name"></truncate>
                            </n-link>
                          </h3>
                          <div class="price ltr:text-right rtl:text-left w-2/5">
                            <p
                              class="line-through text-red-color text-xs font-bold ltr:pr-2 rtl:pl-2" v-if="item.price">
                              <ConvertPrice :price="formatPrice(item.price)"/>
                              {{symbol}}
                            </p>
                            <p class="text-dark-blue text-base font-bold">
                              <ConvertPrice :price="formatPrice(item.price_after)"/>
                              {{symbol}}
                            </p>
                          </div>
                        </div>
                      </div><!-- offer-title -->
                      <div class="offer-info flex items-center content-center border-solid border rounded">
                        <div class="beds w-1/3 py-2">
                          <div class="text-center">
                            <img src="/img/bed.svg" class="text-dark-blue bed-icon mb-2" alt="bed icon">
                            <p class="text-main-color text-xs font-bold"><span class="ltr:pr-1 rtl:pl-1">{{item.bedrooms}}</span>Bedrooms
                            </p>
                          </div>
                        </div>
                        <div class="house w-1/3 py-2">
                          <div class="text-center">
                            <img src="/img/home.svg" class="mb-2 home-icon" alt="home icon">
                            <p class="text-main-color text-xs font-bold"><span class="ltr:pr-1 rtl:pl-1">{{item.total_area}}</span>M<sup>2</sup>
                            </p>
                          </div>
                        </div>
                        <div class="bathroom w-1/3 py-2">
                          <div class="text-center">
                            <img src="/img/bathroom.svg" class="bath-icon mb-2" alt="bathroom icon">
                            <p class="text-main-color text-xs font-bold"><span class="ltr:pr-1 rtl:pl-1">{{item.bathrooms}}</span>Bathrooms
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="md-lg:flex md-lg:flex-wrap md-lg:items-stretch">
              <div class="search-box bg-white rounded-lg pt-6 pb-2 px-4 mb-6 md-lg:w-1/2 md-lg:px-2">
                <h3 class="text-sm font-bold text-main-color pb-8 border-b -mx-4 px-4">Search for Real Estate</h3>
                <form @submit.prevent="submitSearch">
                  <no-ssr>
                    <ais-instant-search-ssr>
                      <ul class="filter-search list-reset">
                        <li class="border-b py-4 -mx-4 px-4 relative" :class="{ active : active_el === 1 }"
                            @click="activate(1)">
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.apartment_type')}} </span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                          </div>
                          <ais-refinement-list
                            :attribute="apartment_type"
                          />
                        </li>
                        <li class="border-b py-4 -mx-4 px-4 relative" :class="{ active : active_el === 2 }"
                            @click="activate(2)">
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.bedrooms')}} </span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                          </div>
                          <ais-refinement-list
                            :attribute="rooms"
                          />
                          <!--                          <ais-numeric-menu-->
                          <!--                            attribute="bedrooms"-->
                          <!--                            :items="[-->
                          <!--                              {label: $t('home.all') },-->
                          <!--                              {label: $t('home.studio'), end: 0},-->
                          <!--                              {label: $t('home.lounge_&_room'), end: 1, start: 1},-->
                          <!--                              {label: $t('home.lounge_&_2rooms'), end: 2, start: 2},-->
                          <!--                              {label: $t('home.lounge_&_3rooms'), end: 3, start: 3},-->
                          <!--                              {label: $t('home.lounge_&_4rooms'), end: 4, start: 4},-->
                          <!--                              {label: $t('home.lounge_&_more_than_4rooms'), start: 5},-->
                          <!--                          ]"-->
                          <!--                          >-->
                          <!--                            <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                          <!--                              <li v-for="item in items" :key="item.value">-->
                          <!--                                <a-->
                          <!--                                  :href="createURL(item.value)"-->
                          <!--                                  :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                          <!--                                  :class="item.isRefined ? 'active' : ''"-->
                          <!--                                  @click.prevent="refine(item.value)"-->
                          <!--                                >-->
                          <!--                                  {{ item.label }}-->
                          <!--                                </a>-->
                          <!--                              </li>-->
                          <!--                            </ul>-->
                          <!--                          </ais-numeric-menu>-->
                        </li>
                        <li class="border-b py-4 -mx-4 px-4 relative" :class="{ active : active_el === 3 }"
                            @click="activate(3)">
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.price')}} </span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                          </div>
                          <ais-refinement-list
                            :attribute="price"
                          />
                        </li>
                        <li class="py-4 -mx-4 px-4 relative" :class="{ active : active_el === 4 }" @click="activate(4)">
                          <div class="md:flex md:items-center md:justify-between md:px-2">
                            <span class="cursor-pointer text-main-color font-bold text-base md:text-sm md:font-normal">{{$t('home.total_area')}} </span>
                            <i
                              class="fas fa-chevron-down ltr:pl-2 rtl:pr-2 xxs:ltr:pl-0 xxs:rtl:pr-0 text-main-color"></i>
                          </div>
                          <ais-refinement-list
                            :attribute="area"
                          />
                          <!--                          <ais-numeric-menu-->
                          <!--                            attribute="total_area"-->
                          <!--                            :items="[-->
                          <!--                              {label: $t('home.all')},-->
                          <!--                              {label: $t('home.less_than')+' 50 '+$t('home.m2'), end: 50},-->
                          <!--                              {label: $t('home.between')+' 50 '+ $t('home.m2') +' '+$t('home.and')+' 100 '+ $t('home.m2'), end: 100, start: 50},-->
                          <!--                              {label: $t('home.between')+' 100 '+ $t('home.m2') +' '+$t('home.and')+' 150 '+ $t('home.m2'), end: 150, start: 100},-->
                          <!--                              {label: $t('home.between')+' 150 '+ $t('home.m2') +' '+$t('home.and')+' 200 '+ $t('home.m2'), end: 200, start: 150},-->
                          <!--                              {label: $t('home.between')+' 200 '+ $t('home.m2') +' '+$t('home.and')+' 250 '+ $t('home.m2'), end: 250, start: 200},-->
                          <!--                              {label: $t('home.more_than')+' 250 '+ $t('home.m2'), start: 250},-->
                          <!--                          ]"-->
                          <!--                          >-->
                          <!--                            <ul class="custom-filter" slot-scope="{ items, refine, createURL }">-->
                          <!--                              <li v-for="item in items" :key="item.value">-->
                          <!--                                <a-->
                          <!--                                  :href="createURL(item.value)"-->
                          <!--                                  :style="{ fontWeight: item.isRefined ? 'bold' : '' }"-->
                          <!--                                  :class="item.isRefined ? 'active' : ''"-->
                          <!--                                  @click.prevent="refine(item.value)"-->
                          <!--                                >-->
                          <!--                                  {{ item.label }}-->
                          <!--                                </a>-->
                          <!--                              </li>-->
                          <!--                            </ul>-->
                          <!--                          </ais-numeric-menu>-->
                        </li>
                        <div class="text-center search-icon -mx-4">
                          <button type="submit"
                                  class="h-full w-full text-white rounded-b-lg text-2xl no-underline py-4 -mb-2   px-4 bg-dark-blue">
                            <i
                              class="fas fa-search"></i></button>
                        </div>
                      </ul>
                    </ais-instant-search-ssr>
                  </no-ssr>
                </form>
              </div>
            </div>

          </aside>
        </div>
      </div>
    </div>
    <ContactUs/>

    <div :class="show?'active':''" class="fixed z-40 pin flex items-center justify-center popup-custom">
      <div>
        <div class="absolute pin bg-black opacity-75"></div>
      </div>
      <div class="relative">
        <div class="max-w-lg w-full modal-expired bg-white rounded-lg shadow-2xl px-6 py-6">
          <div>
            <div class="my-4 text-center">
              <h3>{{$t('real_estate.offer_was_expired')}}</h3>
            </div>
          </div>
          <div class="text-center border-t-2 border-gray-200 mt-3 pt-3">
            <button @click.prevent="closeModal"
                    class="px-4 py-2 text-gray-800 font-semibold bg-white hover:bg-gray-100 border rounded focus:outline-none focus:shadow-outline">
              {{$t('app.close')}}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import thumbsSlider from '~/components/slider-thumbs'
  import axios from '~/plugins/axios.js';
  import ConvertPrice from '~/components/ConvertPrice'
  import truncate from 'vue-truncate-collapsed';
  import ContactUs from '~/components/contact-us'
  import "vue-country-code/dist/vue-country-code.css";
  import algoliasearch from 'algoliasearch/lite';
  import {history as historyRouter} from 'instantsearch.js/es/lib/routers';
  import {simple as simpleMapping} from 'instantsearch.js/es/lib/stateMappings';
  import {
    AisInstantSearchSsr,
    AisRefinementList,
    AisNumericMenu,
    createInstantSearch
  } from 'vue-instantsearch';

  const searchClient = algoliasearch(
    'RJ3KVXJDS0',
    'aa87273b8cf837f15bb3dbf00be5311d'
  );

  const {instantsearch, rootMixin} = createInstantSearch({
    searchClient,
    indexName: 'apartments',
    routing: {
      router: historyRouter(),
      stateMapping: simpleMapping(),
    },
  });

  export default {
    beforeMount() {
      instantsearch.hydrate(this.algoliaState);
    },
    mixins: [rootMixin],
    head() {
      return {
        title: this.feature.name + ' - ' + this.$t('app.name'),
        meta: this.feature.seo
      }
    },
    data() {
      return {
        apartment_type: 'apartment_type.name.' + this.$store.app.i18n.locale,
        rooms: 'meta.rooms.' + this.$store.app.i18n.locale,
        price: 'meta.price.' + this.$store.app.i18n.locale,
        area: 'meta.area.' + this.$store.app.i18n.locale,
        swiperOptionTop: {
          spaceBetween: 10,
          centeredSlides: true,
          loop: true,
          loopedSlides: 5,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        },
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
        show: false,
        active_el: null,
      }
    },
    components: {
      AisInstantSearchSsr,
      AisRefinementList,
      AisNumericMenu,
      createInstantSearch,
      thumbsSlider,
      ConvertPrice,
      truncate,
      ContactUs
    },
    mounted() {
      setTimeout(function () {
        // window.main.init();
      }, 100);
      
      // if (this.feature.images.length) {
      //   this.$nextTick(() => {
      //     const swiperTop = this.$refs.swiperTop.swiper;
      //     const swiperThumbs = this.$refs.swiperThumbsParent.$refs.swiperThumbs.swiper;
      //     swiperTop.controller.control = swiperThumbs;
      //     swiperThumbs.controller.control = swiperTop;
      //   })
      // }
    },
    async asyncData({store, error, params}) {
      const data = {
        lang: store.app.i18n._vm.locale,
        slug: params.slug
      };
      let [res] = await Promise.all([
        store.dispatch('getFeature', data),
        store.dispatch('getFeatured', store.app.i18n._vm.locale),
        store.dispatch('getPage', {lang: store.app.i18n._vm.locale, page: 'properties'}) //real-estate
      ]);
      const $apartment_type = 'apartment_type.name.' + store.app.i18n.locale;
      const $rooms = 'meta.rooms.' + store.app.i18n.locale;
      const $price = 'meta.price.' + store.app.i18n.locale;
      const $area = 'meta.area.' + store.app.i18n.locale;
      return instantsearch
        .findResultsState({
          query: '',
          hitsPerPage: 15,
          disjunctiveFacets: [$apartment_type, $rooms, $price, $area],
        })
        .then(() => ({
          algoliaState: instantsearch.getState(),
        }));
    },
    computed: {
      page() {
        return this.$store.state.page;
      },
      feature() {
        if (this.$store.state.feature.expired) {
          this.show = true;
        }
        return this.$store.state.feature;
      },
      featured() {
        return this.$store.state.featured;
      },
      symbol() {
        return this.$store.state.symbol;
      },
      rtl() {
        return this.$store.app.i18n._vm.locale === 'ar' ? true : false
      },
      description() {
        return this.$store.state.page.seo.find((x) => x.name === 'description') ? this.$store.state.page.seo.find((x) => x.name === 'description').content : '';
      },
      settings() {
        return this.$store.state.settings;
      },
    },
    methods: {
      closeModal() {
        this.show = false;
      },
      getPrice(price) {
        if (this.$store.state.currency === 'try')
          return price;
        else
          return parseFloat((price / this.$store.state.currentRate).toString()).toFixed(2);
      },
      submitSearch() {
        this.$router.push({
          path: `${this.$i18n.locale === 'ar' ? '' : '/' + this.$i18n.locale}/properties/istanbul${window.location.search}`,
        })
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
      formatPrice(value) {
        let val = (value / 1).toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
      onSelect({name, iso2, dialCode}) {
        this.call.code = dialCode;
      },
      activate: function (el) {
        if (this.active_el === el)
          this.active_el = null;
        else
          this.active_el = el;
      },
    }

  }
</script>


<style lang="scss" scoped>
  .modal-expired {
    min-width: 250px;
  }

  .estate-details-page {
    background-color: #ebebeb;
  }

  .aside-title {
    border-bottom: 1px solid #f7f7f7;
  }

  .has-danger {
    border-color: #F33950 !important;
  }


  h2, h3 {
    @include respond-to(991px) {
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

  .features-side {
    > img {
      height: 150px;
      object-fit: cover;
    }
  }
</style>

<style lang="scss">
  .estate-details-page {
    .custom-img {
      height: 550px !important;
      object-fit: cover !important;
      @include respond-to(1280px) {
        height: 400px !important;
      }
      @include respond-to(767px) {
        height: 250px !important;
      }
    }

    .fotorama__img {
      width: 100% !important;
      left: 0 !important;
      object-fit: cover !important;
    }
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
  .slick-prev {
    position: absolute;
    #{$opDir}: 0;
    top: 50%;
    z-index: 5;
    color: #fff;
    background: #3489d8;
    padding: 10px;
  }

  .slick-next {
    position: absolute;
    #{$dir}: 0;
    top: 50%;
    z-index: 5;
    color: #fff;
    background: #3489d8;
    padding: 10px;
  }

  .slick-list.draggable {
    padding: 0 !important;
  }

  .small-img {
    height: 125px;
    object-fit: cover;
    @include respond-to(991px) {
      height: 100px;
    }
    @include respond-to(767px) {
      height: 80px;
    }
  }

  .gallery-top {
    height: 80% !important;
    width: 100%;
  }

  .border-b {
    border-color: #f2f2f2;
  }

  .gallery-thumbs {
    height: 20% !important;
    box-sizing: border-box;
    padding: 10px 0;
  }

  .gallery-thumbs .swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
  }

  .gallery-thumbs .swiper-slide-active {
    opacity: 1;
  }

  .vbox-content {
    img {
      width: 40%;
      max-width: 100%;
      object-fit: cover;
    }
  }

  .fotorama__arr:focus:after, .fotorama__fullscreen-icon:focus:after, .fotorama__html, .fotorama__img, .fotorama__nav__frame:focus .fotorama__dot:after, .fotorama__nav__frame:focus .fotorama__thumb:after, .fotorama__stage__frame, .fotorama__stage__shaft, .fotorama__video iframe {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0
  }

  .fotorama--fullscreen, .fotorama__img {
    max-width: 99999px !important;
    max-height: 99999px !important;
    min-width: 0 !important;
    min-height: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    padding: 0 !important
  }

  .fotorama__wrap .fotorama__grab {
    cursor: move;
    cursor: -webkit-grab;
    cursor: -o-grab;
    cursor: -ms-grab;
    cursor: grab
  }

  .fotorama__grabbing * {
    cursor: move;
    cursor: -webkit-grabbing;
    cursor: -o-grabbing;
    cursor: -ms-grabbing;
    cursor: grabbing
  }

  .fotorama__spinner {
    position: absolute !important;
    top: 50% !important;
    left: 50% !important
  }

  .fotorama__wrap--css3 .fotorama__arr, .fotorama__wrap--css3 .fotorama__fullscreen-icon, .fotorama__wrap--css3 .fotorama__nav__shaft, .fotorama__wrap--css3 .fotorama__stage__shaft, .fotorama__wrap--css3 .fotorama__thumb-border, .fotorama__wrap--css3 .fotorama__video-close, .fotorama__wrap--css3 .fotorama__video-play {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }

  .fotorama__caption, .fotorama__nav:after, .fotorama__nav:before, .fotorama__stage:after, .fotorama__stage:before, .fotorama__wrap--css3 .fotorama__html, .fotorama__wrap--css3 .fotorama__nav, .fotorama__wrap--css3 .fotorama__spinner, .fotorama__wrap--css3 .fotorama__stage, .fotorama__wrap--css3 .fotorama__stage .fotorama__img, .fotorama__wrap--css3 .fotorama__stage__frame {
    -webkit-transform: translateZ(0);
    transform: translateZ(0)
  }

  .fotorama__arr:focus, .fotorama__fullscreen-icon:focus, .fotorama__nav__frame {
    outline: 0
  }

  .fotorama__arr:focus:after, .fotorama__fullscreen-icon:focus:after, .fotorama__nav__frame:focus .fotorama__dot:after, .fotorama__nav__frame:focus .fotorama__thumb:after {
    content: '';
    border-radius: inherit;
    background-color: rgba(0, 175, 234, .5)
  }

  .fotorama__wrap--video .fotorama__stage, .fotorama__wrap--video .fotorama__stage__frame--video, .fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html, .fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img, .fotorama__wrap--video .fotorama__stage__shaft {
    -webkit-transform: none !important;
    transform: none !important
  }

  .fotorama__wrap--css3 .fotorama__nav__shaft, .fotorama__wrap--css3 .fotorama__stage__shaft, .fotorama__wrap--css3 .fotorama__thumb-border {
    transition-property: -webkit-transform, width;
    transition-property: transform, width;
    transition-timing-function: cubic-bezier(0.1, 0, .25, 1);
    transition-duration: 0ms
  }

  .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__no-select, .fotorama__video-close, .fotorama__video-play, .fotorama__wrap {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
  }

  .fotorama__select {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text
  }

  .fotorama__nav, .fotorama__nav__frame {
    margin: auto;
    padding: 0
  }

  .fotorama__caption__wrap, .fotorama__nav__frame, .fotorama__nav__shaft {
    -moz-box-orient: vertical;
    display: inline-block;
    vertical-align: middle;
    *display: inline;
    *zoom: 1
  }

  .fotorama__nav__frame, .fotorama__thumb-border {
    box-sizing: content-box
  }

  .fotorama__caption__wrap {
    box-sizing: border-box
  }

  .fotorama--hidden, .fotorama__load {
    position: absolute;
    left: -99999px;
    top: -99999px;
    z-index: -1
  }

  .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__nav, .fotorama__nav__frame, .fotorama__nav__shaft, .fotorama__stage__frame, .fotorama__stage__shaft, .fotorama__video-close, .fotorama__video-play {
    -webkit-tap-highlight-color: transparent
  }

  .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__video-close, .fotorama__video-play {
  }

  @media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 2dppx) {
    .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__video-close, .fotorama__video-play {
    }
  }

  .fotorama__thumb {
    background-color: #7f7f7f;
    background-color: rgba(127, 127, 127, .2)
  }

  @media print {
    .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__thumb-border, .fotorama__video-close, .fotorama__video-play {
      background: none !important
    }
  }

  .fotorama {
    min-width: 1px;
    overflow: hidden
  }

  .fotorama:not(.fotorama--unobtrusive) > *:not(:first-child) {
    display: none
  }

  .fullscreen {
    width: 100% !important;
    height: 100% !important;
    max-width: 100% !important;
    max-height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    background: #000
  }

  .fotorama--fullscreen {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    float: none !important;
    z-index: 2147483647 !important;
    background: #000;
    width: 100% !important;
    height: 100% !important;
    margin: 0 !important
  }

  .fotorama--fullscreen .fotorama__nav, .fotorama--fullscreen .fotorama__stage {
    background: #000
  }

  .fotorama__wrap {
    -webkit-text-size-adjust: 100%;
    position: relative;
    direction: ltr;
    z-index: 0
  }

  .fotorama__wrap--rtl .fotorama__stage__frame {
    direction: rtl
  }

  .fotorama__nav, .fotorama__stage {
    overflow: hidden;
    position: relative;
    max-width: 100%
  }

  .fotorama__wrap--pan-y {
    -ms-touch-action: pan-y
  }

  .fotorama__wrap .fotorama__pointer {
    cursor: pointer
  }

  .fotorama__wrap--slide .fotorama__stage__frame {
    opacity: 1 !important
  }

  .fotorama__stage__frame {
    overflow: hidden
  }

  .fotorama__stage__frame.fotorama__active {
    z-index: 8
  }

  .fotorama__wrap--fade .fotorama__stage__frame {
    display: none
  }

  .fotorama__wrap--fade .fotorama__fade-front, .fotorama__wrap--fade .fotorama__fade-rear, .fotorama__wrap--fade .fotorama__stage__frame.fotorama__active {
    display: block;
    left: 0;
    top: 0
  }

  .fotorama__wrap--fade .fotorama__fade-front {
    z-index: 8
  }

  .fotorama__wrap--fade .fotorama__fade-rear {
    z-index: 7
  }

  .fotorama__wrap--fade .fotorama__fade-rear.fotorama__active {
    z-index: 9
  }

  .fotorama__wrap--fade .fotorama__stage .fotorama__shadow {
    display: none
  }

  .fotorama__img {
    -ms-filter: "alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0;
    border: none !important
  }

  .fotorama__error .fotorama__img, .fotorama__loaded .fotorama__img {
    -ms-filter: "alpha(Opacity=100)";
    filter: alpha(opacity=100);
    opacity: 1
  }

  .fotorama--fullscreen .fotorama__loaded--full .fotorama__img, .fotorama__img--full {
    display: none
  }

  .fotorama--fullscreen .fotorama__loaded--full .fotorama__img--full {
    display: block
  }

  .fotorama__wrap--only-active .fotorama__nav, .fotorama__wrap--only-active .fotorama__stage {
    max-width: 99999px !important
  }

  .fotorama__wrap--only-active .fotorama__stage__frame {
    visibility: hidden
  }

  .fotorama__wrap--only-active .fotorama__stage__frame.fotorama__active {
    visibility: visible
  }

  .fotorama__nav {
    font-size: 0;
    line-height: 0;
    text-align: center;
    display: none;
    white-space: nowrap;
    z-index: 5
  }

  .fotorama__nav__shaft {
    position: relative;
    left: 0;
    top: 0;
    text-align: left
  }

  .fotorama__nav__frame {
    position: relative;
    cursor: pointer
  }

  .fotorama__nav--dots {
    display: block
  }

  .fotorama__nav--dots .fotorama__nav__frame {
    width: 18px;
    height: 30px
  }

  .fotorama__nav--dots .fotorama__nav__frame--thumb, .fotorama__nav--dots .fotorama__thumb-border {
    display: none
  }

  .fotorama__nav--thumbs {
    display: block
  }

  .fotorama__nav--thumbs .fotorama__nav__frame {
    padding-left: 0 !important
  }

  .fotorama__nav--thumbs .fotorama__nav__frame:last-child {
    padding-right: 0 !important
  }

  .fotorama__nav--thumbs .fotorama__nav__frame--dot {
    display: none
  }

  .fotorama__dot {
    display: block;
    width: 4px;
    height: 4px;
    position: relative;
    top: 12px;
    left: 6px;
    border-radius: 6px;
    border: 1px solid #7f7f7f
  }

  .fotorama__nav__frame:focus .fotorama__dot:after {
    padding: 1px;
    top: -1px;
    left: -1px
  }

  .fotorama__nav__frame.fotorama__active .fotorama__dot {
    width: 0;
    height: 0;
    border-width: 3px
  }

  .fotorama__nav__frame.fotorama__active .fotorama__dot:after {
    padding: 3px;
    top: -3px;
    left: -3px
  }

  .fotorama__thumb {
    overflow: hidden;
    position: relative;
    width: 100%;
    height: 100%
  }

  .fotorama__nav__frame:focus .fotorama__thumb {
    z-index: 2
  }

  .fotorama__thumb-border {
    position: absolute;
    z-index: 9;
    top: 0;
    left: 0;
    border-style: solid;
    border-color: #00afea;
    background-image: linear-gradient(to bottom right, rgba(255, 255, 255, .25), rgba(64, 64, 64, .1))
  }

  .fotorama__caption {
    position: absolute;
    z-index: 12;
    bottom: 0;
    left: 0;
    right: 0;
    font-family: 'Helvetica Neue', Arial, sans-serif;
    font-size: 14px;
    line-height: 1.5;
    color: #000
  }

  .fotorama__caption a {
    text-decoration: none;
    color: #000;
    border-bottom: 1px solid;
    border-color: rgba(0, 0, 0, .5)
  }

  .fotorama__caption a:hover {
    color: #333;
    border-color: rgba(51, 51, 51, .5)
  }

  .fotorama__wrap--rtl .fotorama__caption {
    left: auto;
    right: 0
  }

  .fotorama__wrap--no-captions .fotorama__caption, .fotorama__wrap--video .fotorama__caption {
    display: none
  }

  .fotorama__caption__wrap {
    background-color: #fff;
    background-color: rgba(255, 255, 255, .9);
    padding: 5px 10px
  }

  @-webkit-keyframes spinner {
    0% {
      -webkit-transform: rotate(0);
      transform: rotate(0)
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg)
    }
  }

  @keyframes spinner {
    0% {
      -webkit-transform: rotate(0);
      transform: rotate(0)
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg)
    }
  }

  .fotorama__wrap--css3 .fotorama__spinner {
    -webkit-animation: spinner 24s infinite linear;
    animation: spinner 24s infinite linear
  }

  .fotorama__wrap--css3 .fotorama__html, .fotorama__wrap--css3 .fotorama__stage .fotorama__img {
    transition-property: opacity;
    transition-timing-function: linear;
    transition-duration: .3s
  }

  .fotorama__wrap--video .fotorama__stage__frame--video .fotorama__html, .fotorama__wrap--video .fotorama__stage__frame--video .fotorama__img {
    -ms-filter: "alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0
  }

  .fotorama__select {
    cursor: auto
  }

  .fotorama__video {
    top: 32px;
    right: 0;
    bottom: 0;
    left: 0;
    position: absolute;
    z-index: 10
  }

  @-moz-document url-prefix() {
    .fotorama__active {
      box-shadow: 0 0 0 transparent
    }
  }

  .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__video-close, .fotorama__video-play {
    position: absolute;
    z-index: 11;
    cursor: pointer
  }

  .fotorama__arr {
    position: absolute;
    width: 32px;
    height: 32px;
    top: 50%;
    margin-top: -16px
  }

  .fotorama__arr--prev {
    left: 2px;
    background-position: 0 0
  }

  .fotorama__arr--next {
    right: 2px;
    background-position: -32px 0
  }

  .fotorama__arr--disabled {
    pointer-events: none;
    cursor: default;
    *display: none;
    opacity: .1
  }

  .fotorama__fullscreen-icon {
    width: 32px;
    height: 32px;
    top: 2px;
    right: 2px;
    background-position: 0 -32px;
    z-index: 20
  }

  .fotorama__arr:focus, .fotorama__fullscreen-icon:focus {
    border-radius: 50%
  }

  .fotorama--fullscreen .fotorama__fullscreen-icon {
    background-position: -32px -32px
  }

  .fotorama__video-play {
    width: 96px;
    height: 96px;
    left: 50%;
    top: 50%;
    margin-left: -48px;
    margin-top: -48px;
    background-position: 0 -64px;
    opacity: 0
  }

  .fotorama__wrap--css2 .fotorama__video-play, .fotorama__wrap--video .fotorama__stage .fotorama__video-play {
    display: none
  }

  .fotorama__error .fotorama__video-play, .fotorama__loaded .fotorama__video-play, .fotorama__nav__frame .fotorama__video-play {
    opacity: 1;
    display: block
  }

  .fotorama__nav__frame .fotorama__video-play {
    width: 32px;
    height: 32px;
    margin-left: -16px;
    margin-top: -16px;
    background-position: -64px -32px
  }

  .fotorama__video-close {
    width: 32px;
    height: 32px;
    top: 0;
    right: 0;
    background-position: -64px 0;
    z-index: 20;
    opacity: 0
  }

  .fotorama__wrap--css2 .fotorama__video-close {
    display: none
  }

  .fotorama__wrap--css3 .fotorama__video-close {
    -webkit-transform: translate3d(32px, -32px, 0);
    transform: translate3d(32px, -32px, 0)
  }

  .fotorama__wrap--video .fotorama__video-close {
    display: block;
    opacity: 1
  }

  .fotorama__wrap--css3.fotorama__wrap--video .fotorama__video-close {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }

  .fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr, .fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon {
    opacity: 0
  }

  .fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr:focus, .fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon:focus {
    opacity: 1
  }

  .fotorama__wrap--video .fotorama__arr, .fotorama__wrap--video .fotorama__fullscreen-icon {
    opacity: 0 !important
  }

  .fotorama__wrap--css2.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr, .fotorama__wrap--css2.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon {
    display: none
  }

  .fotorama__wrap--css2.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__arr:focus, .fotorama__wrap--css2.fotorama__wrap--no-controls.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon:focus {
    display: block
  }

  .fotorama__wrap--css2.fotorama__wrap--video .fotorama__arr, .fotorama__wrap--css2.fotorama__wrap--video .fotorama__fullscreen-icon {
    display: none !important
  }

  .fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__fullscreen-icon:not(:focus) {
    -webkit-transform: translate3d(32px, -32px, 0);
    transform: translate3d(32px, -32px, 0)
  }

  .fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--prev:not(:focus) {
    -webkit-transform: translate3d(-48px, 0, 0);
    transform: translate3d(-48px, 0, 0)
  }

  .fotorama__wrap--css3.fotorama__wrap--no-controls.fotorama__wrap--slide.fotorama__wrap--toggle-arrows .fotorama__arr--next:not(:focus) {
    -webkit-transform: translate3d(48px, 0, 0);
    transform: translate3d(48px, 0, 0)
  }

  .fotorama__wrap--css3.fotorama__wrap--video .fotorama__fullscreen-icon {
    -webkit-transform: translate3d(32px, -32px, 0) !important;
    transform: translate3d(32px, -32px, 0) !important
  }

  .fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--prev {
    -webkit-transform: translate3d(-48px, 0, 0) !important;
    transform: translate3d(-48px, 0, 0) !important
  }

  .fotorama__wrap--css3.fotorama__wrap--video .fotorama__arr--next {
    -webkit-transform: translate3d(48px, 0, 0) !important;
    transform: translate3d(48px, 0, 0) !important
  }

  .fotorama__wrap--css3 .fotorama__arr:not(:focus), .fotorama__wrap--css3 .fotorama__fullscreen-icon:not(:focus), .fotorama__wrap--css3 .fotorama__video-close:not(:focus), .fotorama__wrap--css3 .fotorama__video-play:not(:focus) {
    transition-property: -webkit-transform, opacity;
    transition-property: transform, opacity;
    transition-duration: .3s
  }

  .fotorama__nav:after, .fotorama__nav:before, .fotorama__stage:after, .fotorama__stage:before {
    content: "";
    display: block;
    position: absolute;
    text-decoration: none;
    top: 0;
    bottom: 0;
    width: 10px;
    height: auto;
    z-index: 10;
    pointer-events: none;
    background-repeat: no-repeat;
    background-size: 1px 100%, 5px 100%
  }

  .fotorama__nav:before, .fotorama__stage:before {
    background-image: linear-gradient(transparent, rgba(0, 0, 0, .2) 25%, rgba(0, 0, 0, .3) 75%, transparent), radial-gradient(farthest-side at 0 50%, rgba(0, 0, 0, .4), transparent);
    background-position: 0 0, 0 0;
    left: -10px
  }

  .fotorama__nav.fotorama__shadows--left:before, .fotorama__stage.fotorama__shadows--left:before {
    left: 0
  }

  .fotorama__nav:after, .fotorama__stage:after {
    background-image: linear-gradient(transparent, rgba(0, 0, 0, .2) 25%, rgba(0, 0, 0, .3) 75%, transparent), radial-gradient(farthest-side at 100% 50%, rgba(0, 0, 0, .4), transparent);
    background-position: 100% 0, 100% 0;
    right: -10px
  }

  .fotorama__nav.fotorama__shadows--right:after, .fotorama__stage.fotorama__shadows--right:after {
    right: 0
  }

  .fotorama--fullscreen .fotorama__nav:after, .fotorama--fullscreen .fotorama__nav:before, .fotorama--fullscreen .fotorama__stage:after, .fotorama--fullscreen .fotorama__stage:before, .fotorama__wrap--fade .fotorama__stage:after, .fotorama__wrap--fade .fotorama__stage:before, .fotorama__wrap--no-shadows .fotorama__nav:after, .fotorama__wrap--no-shadows .fotorama__nav:before, .fotorama__wrap--no-shadows .fotorama__stage:after, .fotorama__wrap--no-shadows .fotorama__stage:before {
    display: none
  }

  html[dir='ltr'] .filter-search {
    li {
      &:nth-child(even) {
        @include respond-to(576px) {
          .ais-RefinementList-list {
            z-index: 30;
            left: 0 !important;
          }
        }
      }

    }
  }

  html[dir='rtl'] .filter-search {
    li {
      &:nth-child(even) {
        @include respond-to(576px) {
          .ais-RefinementList-list {
            z-index: 30;
            right: 0 !important;
          }
        }
      }

    }
  }
</style>
