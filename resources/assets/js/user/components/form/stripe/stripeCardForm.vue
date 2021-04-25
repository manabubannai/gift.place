<template>
    <div class="settlement-form">
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>

        <p class="settlement-txt">
            以下のチェックボックスをチェックすることにより、<a
                href="/term"
                target="__blank"
                >利﻿用規﻿約</a
            >お﻿よ﻿び<a href="/policy" target="__blank">プライバシーポリシー</a
            >﻿に同﻿意す﻿るも﻿の﻿とし﻿ま﻿す﻿。キ﻿ャ﻿ン﻿セ﻿ルす﻿る﻿ま﻿で月﻿額メ﻿ン﻿バ﻿ー﻿シ﻿ッ﻿プ料﻿金
            (現﻿在￥390)﻿
            ﻿は﻿、ご﻿指﻿定﻿のお﻿支﻿払﻿い方﻿法に﻿て自﻿動引﻿き落﻿と﻿しさ﻿れ﻿ま﻿す﻿。お﻿好﻿き﻿なと﻿き﻿にキ﻿ャ﻿ン﻿セ﻿ルし﻿てい﻿た﻿だ﻿け﻿れ﻿ば﻿、そ﻿れ以﻿降﻿は料﻿金﻿を請﻿求さ﻿れ﻿るこ﻿と﻿はあ﻿り﻿ま﻿せ﻿ん﻿。
        </p>

        <div class="settlement-check_container">
            <label class="settlement-check">
                <input
                    type="checkbox"
                    id="card-check"
                    required
                />入力情報を保存する
            </label>
        </div>

        <input
            @click="checkout"
            :disabled="loading"
            class="settlement-submit"
            value="送信する"
        />
        <div v-if="show_result">{{ result_message }}</div>
    </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js'

export default {
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
            this.loading = true
            const route = this.route
            const toasted = this.$toasted

            if (this.validate()) {
                this.stripe
                    .confirmCardSetup(this.clientSecret, {
                        payment_method: {
                            card: this.card,
                            billing_details: {},
                        },
                    })
                    .then(function (result) {
                        if (result.error) {
                            // Display error.message in your UI.
                            toasted.show(result.error.message, {
                                type: 'error',
                            })
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
            }

            this.loading = false
        },

        validate() {
            if (document.getElementById('card-check').checked === false) {
                this.$toasted.show(
                    'チ﻿ェ﻿ッ﻿クボ﻿ッ﻿ク﻿ス﻿をチ﻿ェ﻿ッ﻿クしてください',
                    { type: 'error' }
                )
                return false
            }

            return true
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
