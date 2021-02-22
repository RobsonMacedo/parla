require('./helpers')

window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = require('jquery')

  require('autogrow')

  require('bootstrap-sass')
} catch (e) {}

/**
 * Vue
 */

window.Vue = require('vue')

/**
 * Autoload Vue components
 */
const file = require.context('./components/app/', true, /\.vue$/i)
file.keys().map(file => {
  const name = 'App' + _.last(file.split('/')).split('.')[0]

  return window.Vue.component(name, () =>
    import('./components/app/' + basename(file)),
  )
})

/**
 * Vue Clipboard
 */
import VueClipboard from 'vue-clipboard2'
window.Vue.use(VueClipboard)

/**
 * Vue SweetAlert
 */
import VueSweetalert2 from 'vue-sweetalert2'
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css'
window.Vue.use(VueSweetalert2)

/**
 * Vue Pagination
 */
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

// import Pagination from 'vue-pagination-2'
// window.Vue.component('pagination', Pagination)

/**
 * Lightbox 2
 */

window.lightbox = require('lightbox2')

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Fullcalendar
 */

window.fullcalendar = require('fullcalendar')

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error(
    'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token',
  )
}

/**
 * UUID v4
 */

window.uuidv4 = require('uuid/v4')

require('./store/adminStore')

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     cluster: 'mt1',
//     encrypted: true
// });
