<script setup>
import Multiselect from "vue-multiselect";
</script>

<template>
    <multiselect
        v-model="form.form"
        label="title"
        track-by="id"
        :options="tags"
        :close-on-select="true"
        :multiple="true"
    ></multiselect>
</template>
