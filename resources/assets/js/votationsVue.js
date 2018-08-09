require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('poll-form-wizard', require('./components/forms/newPollForm.vue'));

const app = new Vue({
    el: '#pollsManagement'
});
