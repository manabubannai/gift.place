<template>
    <div class="container">
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>
        <input id="card-holder-name" type="text" placeholder="cardHolderName" />
        <button
            @click="checkout"
            class="mt-4 c-button text-white"
            :disabled="loading"
        >
            申し込む
        </button>
        <div v-if="show_result">{{ result_message }}</div>
    </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js'

export default {
    name: 'StripeFrom',
    props: {
        route: {
            type: String,
            default: '',
        },
        publicKey: {
            type: String,
            default: '',
        },
        clientSecret: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            card: {},
            stripe: {},
            show_result: false,
            loading: false,
            result_message: '',
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            this.stripe = await loadStripe(this.publicKey)
            const elements = this.stripe.elements()
            const style = {
                base: {
                    color: '#000',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#bdbdbd',
                    },
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a',
                },
            }

            // Create an instance of the card Element.
            this.card = elements.create('card', {
                style: style,
                hidePostalCode: true,
            })

            // Add an instance of the card Element into the `card-element` <div>.
            this.card.mount('#card-element')

            this.card.on('change', function (event) {
                const displayError = document.getElementById('card-errors')
                if (event.error) {
                    displayError.textContent = event.error.message
                } else {
                    displayError.textContent = ''
                }
            })
        },
        checkout() {
            const route = this.route
            this.loading = true

            const cardHolderName = document.getElementById('card-holder-name')
            this.stripe
                .confirmCardSetup(this.clientSecret, {
                    payment_method: {
                        card: this.card,
                        billing_details: {
                            name: cardHolderName.value,
                        },
                    },
                })
                .then(function (result) {
                    if (result.error) {
                        // Display error.message in your UI.
                        console.log(result.error)
                    } else {
                        // The setup has succeeded. Display a success message.

                        // PaymentMethod ID apiに渡す
                        // console.log(result.setupIntent.payment_method)

                        const token = document.head.querySelector(
                            'meta[name="csrf-token"]'
                        )
                        let form = document.createElement('form')
                        console.log(route)
                        // form.action = '/card'
                        form.action = route
                        form.method = 'POST'
                        form.innerHTML = `
                                  <input type="hidden" name="_token" value="${token.content}">
                                  <input type="hidden" name="payment_method" value="${result.setupIntent.payment_method}">`
                        // if (this.method === 'PUT') {
                        //     form.insertAdjacentHTML(
                        //         'afterbegin',
                        //         '<input type="hidden" name="_method" value="PUT">'
                        //     )
                        // }
                        document.body.append(form)
                        form.submit()
                    }
                })
        },
    },
}
</script>
<style>
.StripeElement {
    box-sizing: border-box;
    height: 40px;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
    /*box-shadow: 0 1px 3px 0 #e6ebf1;*/
    /*-webkit-transition: box-shadow 150ms ease;*/
    /*transition: box-shadow 150ms ease;*/
}
</style>
