window.$ = window.jQuery = require('jquery');

window.Popper = require('popper.js');

window.swal = require("sweetalert");

require('bootstrap/dist/js/bootstrap');


/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.$.ajaxSetup({
        headers: { "X-CSRF-TOKEN": token.content, 'Accept' : 'application/json' }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}