<template>
    <div />
</template>
<script>
export default {
    props: {
        status: { required: true, type: String },
        message: { required: true, type: String },
    },
    created() {
        this.showToasted(this.status, this.message)
    },
    methods: {
        showToasted(status, message) {
            this.$toasted.show(message, { type: status })
        },
    },
}
</script>
