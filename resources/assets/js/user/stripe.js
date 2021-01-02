import Vue from 'vue'
import Toasted from 'vue-toasted'

Vue.use(Toasted, {
    position: 'top-right',
    duration: 8000,
    containerClass: 'c-toasted',
})

Vue.component(
    'stripe-card-form',
    require('./components/form/stripe/stripeCardForm.vue').default
)

const app = new Vue({ // eslint-disable-line
    el: '#app',
})
