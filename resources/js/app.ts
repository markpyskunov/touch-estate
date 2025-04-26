import './bootstrap'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import i18n from './i18n'
import pinia from './stores'

const app = createApp(App)

app.use(router)
app.use(vuetify)
app.use(i18n)
app.use(pinia)

app.mount('#app')
