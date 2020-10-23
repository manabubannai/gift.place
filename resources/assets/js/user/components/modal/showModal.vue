<template>
    <div />
</template>
<script>
import postMessageModal from './postMessageModal.vue'
export default {
    props: {
        status: { required: true, type: String },
        message: { required: true, type: String },
    },
    created() {
        console.log(1)
        this.showModal(this.status, this.message)
    },
    methods: {
        showModal(status, message) {
            this.$modal.show(
                postMessageModal,
                {},
                {
                    height: 'auto',
                    width: '320',
                }
            )
        },
    },
}
</script>
