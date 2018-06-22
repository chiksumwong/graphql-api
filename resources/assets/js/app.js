import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';

import router from './router'

Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://graphql-api.test/api';

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

new Vue({
    render: h => h(App),
    router,
}).$mount('#app')