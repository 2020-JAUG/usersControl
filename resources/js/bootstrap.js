
import $ from 'jquery';
import 'bootstrap';
import axios from 'axios';

window.$ = $;
window.jQuery = $;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// import axios from 'axios';
// window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
