export default {
  namespaced: true,
  actions: {
    get({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.get('admin/settings').then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    },
    populate({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/settings/populate').then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    },
    save({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/settings/save', data).then(response => {
          commit('setLoading', false, { root: true });
          commit('setSettings', response.data, { root: true });
          resolve();
        })
      })
    },
    populateDatabaseWithTestData({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/settings/populateDatabaseWithTestData').then(() => {
          commit('setLoading', false, { root: true });
          resolve();
        })
      })
    },
    emptyDatabase({commit, rootState}) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/settings/emptyDatabase').then(() => {
          commit('setLoading', false, { root: true });
          resolve();
        })
      })
    }
  },

}