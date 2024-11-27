<script setup>
defineProps({
    message: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <span v-show="message != null">{{ message ?? "" }}</span>
</template>

<style lang="scss" scoped>
span {
    display: block;
    @apply text-red-600 text-sm;
}
</style>
