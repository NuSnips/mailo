<script setup>
import { onMounted, ref } from "vue";
const props = defineProps({
    name: {
        type: String,
        default: "",
    },
});
const model = defineModel({ type: String, required: true });

const input = ref(null);
defineExpose({
    focus: () => input.value.focus(),
});
onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});
</script>

<template>
    <input
        type="text"
        ref="input"
        :id="name"
        v-model="model"
        :name="name"
        class="border-gray-300 rounded-md"
    />
</template>
