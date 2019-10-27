export default {
  namespaced: true,
  actions: {
    delete({commit, rootState}, id) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/users/delete/'+id).then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    },
    create({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/users/create', data).then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    },
    update({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.post('admin/users/update', data).then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    },
    getById({commit, rootState}, id) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.get('admin/users/getById/'+id).then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        }).catch(err => {
          reject(err.response.data.message);
          commit('setLoading', false, { root: true });
        })
      })
    },
    browse({commit, rootState}, data) {
      return new Promise((resolve, reject) => {
        commit('setLoading', true, { root: true });
        rootState.req.get('admin/users', { params: data }).then(response => {
          commit('setLoading', false, { root: true });
          resolve(response.data);
        })
      })
    }
  }
}