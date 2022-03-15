<template>
  <div class="padding-menu">
    <div class="forms-page">
      <div class="forms-img relative">
        <img class="w-full" src="/img/forms-img.png" :title="page.title" :alt="page.image_alt">
        <div class="container-content absolute pin-b pin-x">
          <div class="form-title text-center bg-white p-8 w-4/5 mx-auto rounded-lg  md:w-full md:px-2 md:py-4">
            <h3 class="font-bold text-3xl text-dark-blue mb-8  md:text-lg md:mb-4">Join Our Team</h3>
            <p class="text-main-color text-base font-bold leading-normal md:text-sm contact-desc">We are looking for CVS CV staff for CV format
              in PDF or Word format</p>
          </div>
        </div>

      </div>
      <div class="container-content">
        <form action="">
          <div class="forms-content flex items-center justify-cneter flex-wrap">
            <div class="w-4/5 md:w-full mx-auto">
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Name <span class="required">*</span>
                </label>
                <div class="input-handler ">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Your Name">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Email <span class="required">*</span>
                </label>
                <div class="input-handler ">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Your Email">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Phone Number <span class="required">*</span>
                </label>
                <div class="input-handler relative rounded-lg w-full flex items-center bg-white">
                  <div class="input-number px-3">
                    <vue-country-code class="text-blue-shadow text-sm w-full bg-transparent"
                                      :enabledCountryCode="true" :defaultCountry="'TR'" :disabledFetchingCountry="true" @onSelect="onSelect">
                    </vue-country-code>
                  </div>
                  <input class="appearance-none text-blue-shadow text-sm flex-grow  py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Phone Number">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Nationality <span class="required">*</span>
                </label>
                <div class="input-handler ">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Your Name">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Age <span class="required">*</span>
                </label>
                <div class="input-handler ">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Your Name">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Upload File
                </label>
                <div class="upload-image text-truncate py-3 px-4 w-full rounded-lg">
                  <input id="file" type="file" class="input-file ltr:pin-l rtl:pin-r" accept=".pdf, application/pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                  <span class="file_label ltr:mr-2 rtl:ml-2 text:sm">
                    <i class="fas fa-cloud-upload-alt"></i> <span>Upload File</span>
                  </span>
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Expected salary
                </label>
                <div class="input-handler ">
                  <input class="appearance-none text-blue-shadow text-sm flex-grow py-3 px-4 w-full rounded-lg"
                         type="text"
                         placeholder="Your Name">
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6">
                <label class="block text-main-color text-sm font-bold mb-2">
                  Other notes or additional information
                  <span class="required">*</span>
                </label>
                <div class="input-handler relative rounded-lg w-full flex items-center bg-white">

                  <textarea class="appearance-none text-blue-shadow text-sm flex-grow  py-3 px-4"
                            placeholder="Type Here..." rows="8"></textarea>
                </div>
              </div>
              <div class="w-full px-6 md:px-2 mb-6 text-center">
                <button class="text-white font-bold text-sm custom-button py-3 px-12 rounded-full w-full" type="button">
                  Submit
                </button>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
    <ContactUs />
  </div>
</template>
<script>
  import 'vue-select/dist/vue-select.css';
  import ContactUs from '~/components/contact-us'
  import "vue-country-code/dist/vue-country-code.css";
  export default {
    head(){
      return{
        title: this.$t('app.name') + ' - ' + this.title,
        meta: this.page.seo,
      }
    },
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
      ContactUs
    },
    computed:{
      page() {
        return this.$store.state.page;
      },
      title() {
          return this.page ? this.page.title : this.$t('links.joinUs');
        // const item = this.page.seo.find((x=> {return x.name==='title'}));
        // return item ? item.content : this.$t('links.joinUs');
      }

    },
    async asyncData({store, error}) {
      let res = await Promise.all([
        store.dispatch('getPage', {lang: store.app.i18n._vm.locale, page: 'join-us'})
      ]);
    },
    mounted() {
      // window.main.init();
    },
    methods:{
      onSelect({name, iso2, dialCode}) {
        // this.call.code = dialCode;
      },
    }
  }
</script>
<style lang="scss" scoped>
  .forms-page {
    background-color: #f7f7f7;
  }

  .forms-img {
    img{
      object-fit: cover;
      height: 400px;
      @include respond-to(991px){
        height: 400px;
      }
      @include respond-to(576px){
        height: 300px;
      }
    }
    .form-title {
      box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.03);
    }

    .container-content {
      top: 70%;
      @include respond-to(576px){
        top: 55%;
      }
      .contact-desc{
        @include respond-to(991px){
          padding: 10px;
          text-align: justify;
          height: 110px;
          overflow: hidden;
        }
      }
    }
  }

  .forms-content {
    padding-top: 100px;
    @include respond-to(991px){
      padding-top: 90px;
    }
  }
</style>
<style lang="scss">
  .pointer {
    input {
      cursor: pointer;
    }
  }

  .upload-image {
    background-color: white;
    @include border-radius();
    color: #1a4066;
    transition: all 0.25s;
    font-weight: bold;
    cursor: pointer;
    position: relative;

    > span,
    > i {
      position: relative;
      z-index: 1;
      display: inline-block;
      vertical-align: middle;
    }

    &:hover {
      background-color: #ececec;
    }

    .input-file {
      opacity: 0;
      cursor: pointer;
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      overflow: hidden;
    }
  }
</style>
