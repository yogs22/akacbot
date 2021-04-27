require('alpinejs');

import Vue from 'vue';

Vue.component('chatbot-component', require('./components/ChatbotComponent.vue').default);

const app = new Vue({
    el: '#app',
});
