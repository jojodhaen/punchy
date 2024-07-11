import './assets/main.css'

import VueDatePicker from '@vuepic/vue-datepicker'

import { addIcons, OhVueIcon } from 'oh-vue-icons'
import {
  FaBusinessTime,
  MdAccountcircle,
  MdAccountcircleOutlined,
  MdEditcalendar,
  MdEditcalendarOutlined,
  MdHome,
  MdHomeOutlined
} from 'oh-vue-icons/icons'
import { createPinia } from 'pinia'

import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import '@vuepic/vue-datepicker/dist/main.css'

addIcons(
  MdHome,
  MdHomeOutlined,
  MdAccountcircleOutlined,
  MdAccountcircle,
  MdEditcalendar,
  MdEditcalendarOutlined,
  FaBusinessTime
)

const app = createApp(App)

const pinia = createPinia()

app.use(pinia)
app.use(router)

app.component('VueDatePicker', VueDatePicker)
app.component('OhVueIcon', OhVueIcon)

app.mount('#app')
