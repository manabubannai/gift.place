<template>
    <div class="m-modal">
        <div class="m-modal__content">
            <h4 class="m-modal__content--head">{{ title }}</h4>

            <div class="m-modal__content--text">{{ message }}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: { required: true, type: String },
        message: { required: true, type: String },
    },
    data() {
        return {}
    },
    created() {},

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
