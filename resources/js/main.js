import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)

// Обратный звонок
import Callback from '@callback/vue/callbacks/Callback.vue'
import callback from '@callback/vuex/callbacks/state'
Vue.component('callback', Callback)


//==========Vuetify========================================
import Vuetify from 'vuetify'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
//import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

// Initializer
import initializer from '@initializer/vuex/initializer/state'

import cart from '@cart/vuex/store'

import mutations from "./vuex/mutations";
import getters from "./vuex/getters";

import tab from './components/Tab'
Vue.component('tab', tab)

import LeaderCarousel from './components/LeaderCarousel'
Vue.component('LeaderCarousel', LeaderCarousel)

const store = new Vuex.Store({
  modules: {
    callback,
    initializer,
  },
  mutations,
  getters
  }
)

const app = new Vue({
  el: '#app',
  data: {
    searchText: '',
    selectedAction: 'main',
  },
  store,
  methods: {
    selectTab(value) {
      console.log(value)
      this.selectedAction = value;
      this.$children.forEach(tab => {
        tab.$attrs.name == value? tab.isActive = true: tab.isActive = false;
      });
    },
    goToPage(url) {
      window.location.href=url
    },
    search(event) {
      const text = event.target.value.replace('/','_')
      window.location.href='/find/'+ text
      this.searchText = ''
    },
    showCallback() {
      this.$store.commit('SET_VARIABLE', {module: 'callback', variable: 'isVisible', value: true})
    }
  }
})