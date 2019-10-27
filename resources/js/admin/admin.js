require('../bootstrap');
window.Vue = require('vue');

import vuetify from '../vuetify';

import store from './store';
import router from './router';

import VuejsDialog from 'vuejs-dialog';
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
Vue.use(VuejsDialog);

import Notifications from 'vue-notification';
Vue.use(Notifications);

import VueQuillEditor from 'vue-quill-editor';
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';
Vue.use(VueQuillEditor);

import App from './App.vue';
new Vue({
    vuetify,
    store,
    router,
    render: h => h(App),
    el: '#app',
});
