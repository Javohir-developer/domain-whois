
require('./bootstrap');
import Vue from "vue";
import App from "./components/component_1/App";

//app - 6
const app = new Vue({
    el: '#app',
    components:{App},
});
