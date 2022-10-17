window.axios = require('axios');

require('./bootstrap');

import Vue from 'vue';
import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App)
});


