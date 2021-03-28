import './bootstrap.js'
//Vue
import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router/router.js'
import { initializeStore } from './store/store.js'
import VueTippy from 'vue-tippy'
import 'tippy.js/dist/tippy.css'

initializeStore()

createApp(App)
  .use(router)
  .use(VueTippy)
  .mount('#app')
