<template>
    <div>
        <div
            class="c-message-index-card"
            v-for="message in messages"
            :key="message.id"
        >
            <div class="post-flex">
                <a :href="'/users/' + message.user.slug" class="post-face">
                    <img
                        :src="message.user.cover_url"
                        alt=""
                        class="post-icon"
                    />
                </a>
                <div class="post-txtbox">
                    <a
                        :href="'/users/' + message.user.slug"
                        class="postpage-name"
                    >
                        <p>{{ message.user.name }}</p>
                    </a>
                    <a
                        :href="'/messages/' + message.uuid"
                        style="display: block"
                    >
                        <p class="post-txt">
                            {{ message.description }}
                        </p>
                        <div class="flex_sb">
                            <p class="post-time">
                                {{ message.created_at_jst }}
                                <!-- PM23時55分2021年2月1日 -->
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <infinite-loading
            ref="infiniteLoading"
            spinner="spiral"
            @infinite="infiniteHandler"
        >
            <span slot="no-more">もうないよ〜</span>
        </infinite-loading>
    </div>
</template>

<script>
import * as api from '../../../services/api'
export default {
    props: {
        isUser: {
            type: Boolean,
            default: false,
        },
        userId: {
            type: Number,
        },
    },
    data() {
        return {
            messages: [],
            page: 1,
        }
    },
    created() {},
    methods: {
        async infiniteHandler($state) {
            let params = {}
            if (this.isUser) {
                params = { page: this.page, user_id: this.userId }
            }

            if (!this.isUser) {
                params = { page: this.page }
            }

            let response = await api.getMessage(params)

            response.data.map((data) => this.messages.push(data))

            if (this.messages.length < response.meta.total) {
                this.page = this.page + 1
                $state.loaded()
            } else {
                $state.complete()
            }
        },
    },
}
</script>
