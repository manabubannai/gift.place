<template>
    <div class="text-right">
        <div v-if="!isLiked" class="c-btn-like c-btn-like--disliked">
            <span @click="messageLike()">LIKE</span>
        </div>
        <div v-if="isLiked" class="c-btn-like c-btn-like--liked">
            <span @click="messageDisLike()">LIKE</span>
        </div>
    </div>
</template>

<script>
import * as api from '../../services/api'

export default {
    props: {
        messageId: { required: true, type: Number },
        defaultIsLiked: { required: true, type: Boolean },
        defaultLike: { required: true },
    },
    data() {
        return {
            isLiked: false,
            likeId: 0,
        }
    },
    created() {
        if (this.defaultLike != null) {
            this.likeId = this.defaultLike.id
        }

        this.isLiked = this.defaultIsLiked
    },

    methods: {
        async messageLike() {
            let response = await api.postMessageLike({
                message_id: this.messageId,
            })

            if (response['success'] === true) {
                this.likesCount = response['likesCount']
                this.isLiked = response['isLiked']
                this.likeId = response['like']['id']
            }

            if (response['success'] === false) {
            }
        },

        async messageDisLike() {
            let response = await api.deleteMessageLike(this.likeId, {
                message_id: this.messageId,
                user_id: this.userId,
            })
            if (response['success'] === true) {
                this.likesCount = response['likesCount']
                this.isLiked = response['isLiked']
            }

            if (response['success'] === false) {
            }
        },
    },
}
</script>
<style lang="scss" scoped>
.c-btn-like {
    border: 2px solid #554eff;
    box-sizing: border-box;
    height: 30px;
    cursor: pointer;
    transition-property: all;
    transition-duration: 0.25s;
    transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    border-radius: 3px;
    display: inline-block;
    @apply px-4 font-bold;

    &:hover {
        opacity: 0.8;
    }

    &--liked {
        background: #554eff;
        color: #fff;
    }

    &--disliked {
        background: #fff;
        color: #554eff;
    }
}
</style>
