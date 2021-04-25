<template>
    <div />
</template>
<script>
import postMessageModal from './postMessageModal.vue'
export default {
    props: {
        status: { required: true, type: String },
        title: { required: true, type: String },
        message: { required: true, type: String },
    },
    created() {
        this.showModal()
    },
    methods: {
        showModal() {
            this.$modal.show(
                postMessageModal,
                { title: this.title, message: this.message },
                {
                    height: 'auto',
                    width: '320',
                }
            )
        },
    },
}
</script>
