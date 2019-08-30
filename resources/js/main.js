import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)
import mutations from "./vuex/mutations";
import getters from "./vuex/getters";
//===========End Vuex======================================

//===========Callback======================================
//import Callback from '@callback/vue/callbacks/Callback.vue'
//import callback from '@callback/vuex/callbacks/state'
//Vue.component('callback', Callback)
//===========EndCallback===================================


//==========Vuetify========================================
import Vuetify from 'vuetify'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)
//==========End Vuetify====================================


//==========Vee-validate===================================
import ru from 'vee-validate/dist/locale/ru';
import VeeValidate, { Validator } from 'vee-validate'
Vue.use(VeeValidate)
Validator.localize('ru', ru)
//==========End Vee-validate================================

//=========Initializer======================================
import initializer from '@initializer/vuex/initializer/state'
//=========End Initializer==================================

//=========Global components================================
import tab from './components/Tab'
Vue.component('tab', tab)

import LeaderCarousel from './components/LeaderCarousel'
Vue.component('LeaderCarousel', LeaderCarousel)

import CallbackForm from '@callback/vue/callbacks/Form'
Vue.component('callback-form', CallbackForm)
//=========End Global components============================


const store = new Vuex.Store(
  {
      modules: {
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