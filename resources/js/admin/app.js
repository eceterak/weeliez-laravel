require('./bootstrap');

/* Vue.js */
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

Vue.component('motorcycle-form', require('./components/MotorcycleForm.vue').default);
Vue.component('specs-form', require('./components/SpecsForm.vue').default);
Vue.component('search-select', require('./components/SearchSelect.vue').default);

Vue.prototype.$adminPath = 'admin0123rwq2';

const app = new Vue({
    el: '#app'
});
