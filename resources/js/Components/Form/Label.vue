<script setup>
const props = defineProps({
    name: { type: String },
    label: { type: String },
});
</script>
<template>
    <label for="name" class="uppercase text-sm">
        <slot />
    </label>
</template>
