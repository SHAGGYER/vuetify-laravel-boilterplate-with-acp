export default {
  namespaced: true,
  actions: {
    install({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/auth/install', data).then(response => {
          commit('setAdmin', response.data.admin, { root: true });
          commit('setSettings', response.data.settings, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        })
      })
    },
    init({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.get('admin/auth/init').then(response => {
          commit('setAdmin', response.data.admin, { root: true });
          commit('setInstalled', response.data.isInstalled, { root: true });
          commit('setSettings', response.data.settings, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        })
      })
    },
    login({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/auth/login', data).then(response => {
          commit('setAdmin', response.data.admin, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        }).catch(err => {
          commit('setLoading', false, { root: true });
          reject(err.response.data.message);
        });
      })
    },
    logout({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/auth/logout').then(response => {
          commit('setAdmin', response.data.admin, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        }).catch(err => {
          commit('setLoading', false, { root: true });
          reject(err.response.data.message);
        });
      })
    }
  }
}