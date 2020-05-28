require('./bootstrap');
window.Vue = require('vue');
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import VueSwal from 'vue-swal';
Vue.use(VueSwal);
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('other-settings-component', require('./components/settings/OtherSettings.vue').default);
// Vue.component('general-settings-component', require('./components/settings/GeneralSettings.vue').default);
//mail
Vue.component('mail-component', require('./components/mails/mailLoginIdAll.vue').default);
Vue.component('data-table', require('./components/UserDatatable.vue').default);


const app = new Vue({
    el: '#app',
});
