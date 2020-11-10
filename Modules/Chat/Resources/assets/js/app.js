require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueSocketio from 'vue-socket.io'
import socketio from 'socket.io-client'
Vue.use(VueSocketio, socketio(':6999'));
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
import vContext from 'vue-context';

Vue.component('messages', require('./components/MessageComponent.vue'));
Vue.component('users', require('./components/UsersComponent.vue'));
Vue.component('private-chat', require('./components/PrivateChatComponent.vue'));
Vue.component('owner', require('./components/OwnerComponent.vue'));
Vue.component('vContext', require('vue-context'));

const app = new Vue({
    el: '#app'
});
