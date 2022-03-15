<template>
  <div class="padding-menu">
    <div class="forms-page">
      <div class="forms-img relative">
        <img class="w-full" src="/img/forms-img.png" alt="">
        <div class="container-content absolute pin-b pin-x">
          <div class="form-title text-center bg-white p-8 w-4/5 mx-auto rounded-lg">
            <h3 class="font-bold text-3xl text-dark-blue mb-8">Form Title Goes Here</h3>
            <p class="text-main-color text-base font-bold leading-normal">Lorem ipsum dolor sit amet, consectetur
              adipiscing elit, sed
              do
              eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
              ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
              fugiat
              nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
              anim id est laborumorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod .</p>
          </div>
        </div>

      </div>
      <div class="container-content">
        <form action="">
          <div class="forms-content flex items-center flex-wrap -mx-6">
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Name <span class="required">*</span>
              </label>
              <div class="input-handler ">
                <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                       type="text"
                       placeholder="Your Name">
              </div>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Phone Number <span class="required">*</span>
              </label>
              <div class="input-handler relative rounded-lg w-full flex items-center bg-white">
                <div class="input-number px-3">
                  <v-select class="form-select key-number text-sm text-blue-shadow" :options="number" :multiple="false"
                            :placeholder="'00970'"></v-select>
                </div>
                <input class="appearance-none text-blue-shadow text-sm flex-grow  py-3 px-4"
                       type="text"
                       placeholder="Phone Number">
              </div>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Gender <span class="required">*</span>
              </label>
              <v-select class="form-select text-blue-shadow py-2 px-4" :options="options"
                        :placeholder="'Select Gender'"></v-select>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Gender <span class="required">*</span>
              </label>
              <v-select class="form-select text-blue-shadow py-2 px-4" :options="options"
                        :placeholder="'Select Gender'"></v-select>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Multi Select
              </label>
              <v-select class="form-select form-multiple text-blue-shadow py-2 px-4" :options="multi" :multiple="true"
                        :placeholder="'Multi Select'"></v-select>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Multi Select
              </label>
              <v-select class="form-select form-multiple text-blue-shadow py-2 px-4" :options="multi" :multiple="true"
                        :placeholder="'Multi Select'"></v-select>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Price Range <span class="required">*</span>
              </label>
              <div>value: {{ value }}</div>
              <vue-slider
                v-model="value"
                :enable-cross="false"
                :max="1000"
              ></vue-slider>
            </div>
            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Phone Number <span class="required">*</span>
              </label>
              <div class="input-handler relative rounded-lg w-full flex items-center bg-white">
                <input class="appearance-none text-blue-shadow text-sm flex-grow  py-3 px-4"
                       type="text"
                       placeholder="Price">
                <div class="input-number px-3">
                  <v-select class="form-select key-number text-sm text-blue-shadow" :options="price" :multiple="false"
                            :placeholder="'00.00'"></v-select>
                </div>
              </div>
            </div>

            <div class="w-1/2 px-6 mb-6">
              <label class="block text-main-color text-sm font-bold mb-2">
                Upload Image
              </label>


            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</template>
<script>
  import 'vue-select/dist/vue-select.css';
  import VueSlider from 'vue-slider-component/dist-css/vue-slider-component.umd.min.js'
  import 'vue-slider-component/dist-css/vue-slider-component.css'
  import 'vue-slider-component/theme/default.css'

  export default {
    data() {
      return {
        options: [
          'Male',
          'Female',
        ],
        multi: [
          'select 1',
          'select 2'
        ],
        number: [
          '00972',
          '00970',
          '00966',
          '0090'

        ],
        price: [
          'USD',
          'TRY'
        ],
        value: [0, 1000],

      }
    },
    components: {
      VueSlider,
    },
    mounted() {
      // window.main.init();
    }
  }
</script>
<style lang="scss" scoped>
  .forms-page {
    background-color: #f7f7f7;
  }

  .forms-img {
    .form-title {
      box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.03);
    }

    .container-content {
      top: 70%;
    }
  }

  .forms-content {
    padding-top: 220px;
  }
</style>
