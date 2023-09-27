import {createApp} from 'vue';
import router from './router';
import store from './store';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'jquery/src/jquery.js';
import 'bootstrap/dist/js/bootstrap.min.js';
import './registerServiceWorker';


createApp(App).use(store).use(router).mount('#app');
