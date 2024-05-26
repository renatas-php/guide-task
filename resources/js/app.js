import './bootstrap';
import {createApp} from 'vue'
import App from './App.vue';
import router from './Routes/index';

createApp(App)
.use(router)
.mount("#app")