require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import App from './App';
import routes from './routes';


Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {App},
    router: new VueRouter(routes)
});
