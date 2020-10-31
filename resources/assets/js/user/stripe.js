import Vue from 'vue'

Vue.component(
    'stripe-card-form',
    require('./components/form/stripe/stripeCardForm.vue').default
)

const app = new Vue({ // eslint-disable-line
    el: '#app',
})
