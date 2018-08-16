require('./bootstrap');

window.Vue = require('vue');

Vue.component('poll-form-wizard', require('./components/forms/newPollForm.vue'));
Vue.component('votations-table', require('./components/votaciones.vue'));

const app = new Vue({
    el: '#pollsManagement',
    methods: {
        notifyComp(){
            this.$refs.pollsTable.updatePolls();
        }
    }
});
