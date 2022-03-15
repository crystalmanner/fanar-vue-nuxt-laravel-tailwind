import axios, { siteURL } from "~/plugins/axios.js";

export const state = () => ({
  siteURL: siteURL,
  locales: ["en", "ar"],
  locale: "en",
  settings: {},
  videos: [],
  blogs: [],
  blog: {},
  featured: [],
  apartment: [],
  page: [],
  menu: [],
  subMenu: [],
  popups: [],
  currentPage: "home",
  currency: "try",
  symbol: "(₺)",
  currentRate: 5.7
});

export const mutations = {
  setLang(state, locale) {
    state.locale = locale;
  },
  setSettings: (state, settings) => {
    state.settings = settings;
  },
  setVideos: (state, item) => {
    state.videos = item;
  },
  setBlogs: (state, item) => {
    state.blogs = item;
  },
  setBlog: (state, item) => {
    state.blog = item;
  },
  setFeatured: (state, item) => {
    state.featured = item;
  },
  setFeature: (state, item) => {
    state.feature = item;
  },
  setApartment: (state, item) => {
    state.apartment = item;
  },
  setPage: (state, item) => {
    state.page = item;
  },
  setMenu: (state, item) => {
    state.menu = item;
  },
  setSubMenu: (state, item) => {
    state.subMenu = item;
  },
  setPopups: (state, item) => {
    state.popups = item;
  },
  setCurrentPage: (state, item) => {
    state.currentPage = item;
  },
  setCurrency: (state, item) => {
    state.currency = item;
  },
  setSymbol: (state, item) => {
    state.symbol = item;
  },
  setCurrentRate: (state, item) => {
    state.currentRate = item;
  },
  setSeo: (state, item) => {
    state.seo = item;
  }
};

export const actions = {
  async getSettings({ commit }, lang) {
    let { data } = await axios.get(`/user-api/settings`);
    data.settings.Location = JSON.parse(data.settings.Location);
    commit("setSettings", data.settings);
  },
  async getVideos({ commit }, lang) {
    let { data } = await axios.get(`/user-api/${lang}/videos`);
    commit("setVideos", data.resources);
  },
  async getBlogs({ commit }, lang) {
    let { data } = await axios.get(
      `/user-api/ar/articles?filters=W3siY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXFR5cGVGaWx0ZXIiLCJ2YWx1ZSI6IiJ9LHsiY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXFN0YXR1c0ZpbHRlciIsInZhbHVlIjoiYWN0aXZlIn0seyJjbGFzcyI6IkFwcFxcTm92YVxcRmlsdGVyc1xcRnJvbURhdGVGaWx0ZXIiLCJ2YWx1ZSI6IiJ9LHsiY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXFRvRGF0ZUZpbHRlciIsInZhbHVlIjoiIn1d`
    );
    commit("setBlogs", data.resources);
  },
  async getBlog({ commit }, obj) {
    let { data } = await axios
      .get(`/user-api/ar/articles/${obj.slug}`)
      .catch(error => {
        location.href = "/404";
      });
    commit("setBlog", data);
  },
  async getFeatured({ commit }, lang) {
    let { data } = await axios.get(
      `/user-api/${lang}/apartments?filters=W3siY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXE9mZmVyRmlsdGVyIiwidmFsdWUiOiIifSx7ImNsYXNzIjoiQXBwXFxOb3ZhXFxGaWx0ZXJzXFxTaG93SW5Ib21lIiwidmFsdWUiOiJmZWF0dXJlZF9vZmZlciJ9LHsiY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXEZyb21EYXRlRmlsdGVyIiwidmFsdWUiOiIifSx7ImNsYXNzIjoiQXBwXFxOb3ZhXFxGaWx0ZXJzXFxUb0RhdGVGaWx0ZXIiLCJ2YWx1ZSI6IiJ9XQ==`
    );
    commit("setFeatured", data.resources);
  },
  async getFeature({ commit }, obj) {
    let { data } = await axios
      .get(`/user-api/${obj.lang}/apartments/${obj.slug}`)
      .catch(error => {
        location.href = "/404";
      });
    commit("setFeature", data);
  },
  async getApartment({ commit }, lang) {
    let { data } = await axios.get(
      `/user-api/${lang}/apartments?filters=W3siY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXE9mZmVyRmlsdGVyIiwidmFsdWUiOiIifSx7ImNsYXNzIjoiQXBwXFxOb3ZhXFxGaWx0ZXJzXFxTaG93SW5Ib21lIiwidmFsdWUiOiJmZWF0dXJlZF9wcm9qZWN0In0seyJjbGFzcyI6IkFwcFxcTm92YVxcRmlsdGVyc1xcRnJvbURhdGVGaWx0ZXIiLCJ2YWx1ZSI6IiJ9LHsiY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXFRvRGF0ZUZpbHRlciIsInZhbHVlIjoiIn1d`
    );
    commit("setApartment", data.resources);
  },
  async getPage({ commit }, { lang, page }) {
    let { data } = await axios.get(`/user-api/${lang}/page/${page}`);
    commit("setPage", data.data);
  },
  async getMenu({ commit }, lang) {
    let { data } = await axios.get(`/user-api/${lang}/menu`);
    commit("setMenu", data);
  },
  async getSubMenu({ commit }, lang) {
    let { data } = await axios.get(`/user-api/${lang}/municipalities`);
    commit("setSubMenu", data.data);
  },
  async getPopups({ commit }, lang) {
    let { data } = await axios.get(`/user-api/${lang}/popups`);
    commit("setPopups", data.resources);
  },
  async getSeo({ commit }, lang) {
    commit("setSeo", data.resources);
  },
  getCurrentPage({ commit }, page) {
    commit("setCurrentPage", page);
  },
  getSymbol({ commit }, item) {
    commit("setSymbol", item);
  },
  getCurrency({ commit }, item) {
    if (item === "try") commit("setSymbol", "(₺)");
    else commit("setSymbol", "($)");
    commit("setCurrency", item);
  },
  async getCurrentRate({ commit }) {
    // let {data} = await axios.get(`http://apilayer.net/api/live?access_key=dbdb1047ea4ef274373299e23c946c05`);
    let { data } = await axios.get(`/api/currency`);

    if (data.success) {
      commit("setCurrentRate", data.quotes.USDTRY);
    }
  },
  nuxtServerInit({ dispatch }, context) {
    return Promise.all([
      dispatch("getSettings", context.app.i18n._vm.locale),
      dispatch("getMenu", context.app.i18n._vm.locale),
      dispatch("getPopups", context.app.i18n._vm.locale),
      dispatch("getCurrentRate"),
      dispatch("getSubMenu", context.app.i18n._vm.locale)
    ]);
  }
};
