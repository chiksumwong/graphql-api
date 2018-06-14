import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

/*
 * Components
 */
import Dashboard from '../components/Dashboard.vue';
import Home from '../components/Home.vue';
import Register from '../components/Register.vue';
import Login from '../components/Login.vue';


/*
 * Routers
 */
export default new VueRouter({
  mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    }]
})