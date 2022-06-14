
require('./bootstrap');
import Vue from "vue";

//app - 6
import App from "./components/component_1/App";
import Home from "./components/component_1/Home";
import View from "./components/component_1/View";
import VueRouter from 'vue-router'
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/view/:image',
            name: 'view',
            component: View,
            props:true
        }
    ]
});
const app = new Vue({
    el: '#app',
    components:{App},
    router
});
