require('../bootstrap');
window.Vue = require('vue');

import vuetify from '../vuetify';

import store from './store';
import router from './router';

import VuejsDialog from 'vuejs-dialog';
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
Vue.use(VuejsDialog);

import App from './App.vue';
new Vue({
    vuetify,
    store,
    router,
    render: h => h(App),
    el: '#app',
});
