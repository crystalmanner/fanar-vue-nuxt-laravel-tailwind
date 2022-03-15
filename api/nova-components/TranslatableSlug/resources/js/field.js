Nova.booting((Vue, router) => {
    Vue.component('index-translatable-slug-field', require('./components/IndexField'));
    Vue.component('detail-translatable-slug-field', require('./components/DetailField'));
    Vue.component('form-translatable-slug-field', require('./components/FormField'));
})
