

import { createApp } from 'vue'
const app = createApp({})

import axios from './vue/config/axios.js'
import LoadScript from 'vue-plugin-load-script';
import Principal from './vue/components/Principal.vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

app.use(LoadScript);
app.use(VueSweetalert2);

app.component("principal",Principal)
app.mount('#app')
