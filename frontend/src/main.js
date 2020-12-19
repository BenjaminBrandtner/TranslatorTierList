import './bootstrap.js'
//Vue
import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router/router.js'
import { initializeStore } from './store/store.js'

initializeStore()

createApp(App).use(router).mount('#app')
