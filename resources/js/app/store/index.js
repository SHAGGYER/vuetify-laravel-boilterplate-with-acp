import Vue from 'vue';
import Vuex from 'vuex';
import axios from "axios";
import Helpers from "../../helpers/helpers";

Vue.use(Vuex);

import auth from "./auth";

export default new Vuex.Store({
  state: {
    user: null,
    settings: null,
    loading: false,
    req: axios.create({
      baseURL: BASE_URL
    }),
    helpers: Helpers,
    installed: false
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setLoading(state, loading) {
      state.loading = loading;
    },
    setInstalled(state, installed) {
      state.installed = installed;
    },
    setSettings(state, settings) {
      state.settings = settings;
    },


  },
  modules: {
    auth,
  },
  getters: {
    appTitle(state) {
      if (!state.settings) return;
      let setting = state.settings.find(_s => _s.key === 'appTitle');
      return setting.value;
    },

  }
});