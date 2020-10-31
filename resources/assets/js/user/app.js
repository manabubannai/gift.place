/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'
import Toasted from 'vue-toasted'

Vue.use(Toasted, {
    position: 'top-right',
    duration: 8000,
    containerClass: 'c-toasted',
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.prototype.$axios = window.axios

Vue.component('toast', require('./components/toast.vue').default)

/* ============================================================================
 * button
 * ========================================================================= */
Vue.component(
    'message-like-button',
    require('./components/button/messageLikeButton.vue').default
)

/* ============================================================================
 * form
 * ========================================================================= */
// Vue.component(
//     'stripe-card-form',
//     require('./components/form/stripe/stripeCardForm.vue').default
// )

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(function () {
    $('.m-hamburger').click(function () {
        $(this).toggleClass('active')

        if ($(this).hasClass('active')) {
            $('.globalMenuSp').addClass('active')
        } else {
            $('.globalMenuSp').removeClass('active')
        }
    })
})

$(function () {
    $('a[href^="#"]').click(function () {
        var speed = 500
        var href = $(this).attr('href')
        var target = $(href == '#' || href == '' ? 'html' : href)
        var position = target.offset().top
        $('html, body').animate({ scrollTop: position }, speed, 'swing')
        return false
    })
})

const app = new Vue({ // eslint-disable-line
    el: '#app',
})
