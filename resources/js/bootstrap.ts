import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//@ts-ignore
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
