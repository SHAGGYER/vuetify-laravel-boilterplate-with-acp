export default {
  namespaced: true,
  actions: {
    init({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.get('app/auth/init').then(response => {
          commit('setUser', response.data.user, { root: true });
          commit('setInstalled', response.data.isInstalled, { root: true });
          commit('setSettings', response.data.settings, { root: true });
          commit('setLoading', false, { root: true });
          resolve(response.data.isInstalled);
        })
      })
    },
    login({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('app/auth/login', data).then(response => {
          commit('setUser', response.data.user, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        }).catch(err => {
          commit('setLoading', false, { root: true });
          reject(err.response.data.message);
        });
      })
    },
    register({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('app/auth/register', data).then(response => {
          commit('setUser', response.data.user, { root: true });
          commit('setLoading', false, { root: true });
          resolve();
        }).catch(err => {
          commit('setLoading', false, { root: true });
          reject(err.response.data);
        });
      })
    },
    logout({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('app/auth/logout').then(response => {
          commit('setUser', null, { root: true });
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