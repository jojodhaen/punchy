import './assets/main.css'

import VueDatePicker from '@vuepic/vue-datepicker'
import { createPinia } from 'pinia'

import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import '@vuepic/vue-datepicker/dist/main.css'

const app = createApp(App)

const pinia = createPinia()

app.use(pinia)
app.use(router)

app.component('VueDatePicker', VueDatePicker)

app.mount('#app')
