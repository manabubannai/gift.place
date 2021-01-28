<template>
    <div class="m-modal">
        <div class="m-modal__content">
            <h4 class="m-modal__content--head">タイトル</h4>

            <div class="m-modal__content--text"></div>
        </div>
    </div>
</template>
<script>
export default {
    props: {},
    data() {
        return {}
    },
    created() {
        console.log(2)
    },

    methods: {},
}
</script>
<style lang="scss" scoped>
.m-modal {
    padding: 16px 16px 0 16px;

    .bold {
        font-weight: 600;
    }
}
</style>
