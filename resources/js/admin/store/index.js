import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

import auth from './auth';
import admins from "./admins";
import users from "./users";
import settings from "./settings";

import Helpers from '../../helpers/helpers';

export default new Vuex.Store({
  state: {
    admin: null,
    settings: null,
    loading: false,
    req: axios.create({
      baseURL: BASE_URL
    }),
    helpers: Helpers,
    installed: false
  },
  mutations: {
    setAdmin(state, admin) {
      state.admin = admin;
    },
    setLoading(state, loading) {
      state.loading = loading;
    },
    setInstalled(state, installed) {
      state.installed = installed;
    },
    setSettings(state, settings) {
      state.settings = settings;
    }
  },
  actions: {
      getSettingByKey({commit, state}, key) {
        return new Promise((resolve, reject) => {
          const _setting = state.settings.find(setting => setting.key === key);
          resolve(_setting);
        })
      },
    getDashboardData({commit, state}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true);
        state.req.get('admin/getDashboardData').then(response => {
          commit('setLoading', false);
          resolve(response.data);
        })
      })
    }
  },
  getters: {
    currency(state) {
      if (state.settings.length) {
        let setting = state.settings.find(_s => _s.key === 'currency');
        let options = JSON.parse(setting.options);
        let display = options.find(option => option.key === setting.value);
        return display.text;
      }

    }
  },
  modules: {
    auth,
    users,
    settings,
    admins
  }
});