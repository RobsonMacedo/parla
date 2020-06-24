require('./bootstrap')

require('./apps/parla.js')

require('./apps/admin.js')

axios.defaults.headers.common = {
  'X-CSRF-TOKEN': Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
  Authorization: 'Bearer ' + Laravel.api_token,
}
