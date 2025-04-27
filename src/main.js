import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

const app = createApp(App)
app.directive('focus', {
  mounted: (element) => element.focus(),
})
app.mount('#app')
