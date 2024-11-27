<script setup>
import { ref } from "vue";
import TextInput from "@/Components/Form/TextInput.vue";
import MainAppLayout from "@/Layouts/MainAppLayout.vue";
import Label from "@/Components/Form/Label.vue";
import { useForm } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";
import InputError from "@/Components/Form/InputError.vue";

const props = defineProps({
    tags: {
        type: Array,
    },
    forms: {
        type: Array,
    },
    errors: {
        type: Object,
    },
});
defineOptions({
    layout: MainAppLayout,
});
let form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    form_id: "",
    tag_ids: [],
});
const selectedTags = ref([]);
const selectedForm = ref(null);

const submitForm = () => {};
const onSelectTagList = (option) => {
    form.tag_ids.push(option.id);
};
const onRemoveTagList = (option) => {
    form.tag_ids = form.tag_ids.filter((item) => item != option.id);
};
const onSelectForm = (option, re) => {
    form.form_id = option.id;
};
const onRemoveForm = (option) => {
    form.form_id = null;
};
</script>

<template>
    <Head>
        <title>Subscribe</title>
        <!-- <meta name="description" content="Your page description" /> -->
    </Head>

    <div class="p-3 bg-white rounded-md shadow-md max-w-3xl m-auto">
        <div class="px-6 py-3">
            <div class="w-full text-center">
                <h1 class="font-bold text-3xl pt-4">Mailo</h1>
                <h2 class="pt-2 pb-3 text-xl w-full">Subscribe to Topics</h2>
            </div>
            <form
                @submit.prevent="form.post('/subscribe')"
                method="POST"
                class="pt-3"
            >
                <div class="flex justify-between gap-8 pb-8">
                    <div class="flex flex-col w-full">
                        <Label name="first_name">First Name</Label>
                        <TextInput
                            name="first_name"
                            v-model="form.first_name"
                        />
                        <InputError :message="errors.first_name" />
                    </div>
                    <div class="flex flex-col w-full">
                        <Label name="last_name">Last Name</Label>
                        <TextInput name="last_name" v-model="form.last_name" />
                        <InputError :message="errors.last_name" />
                    </div>
                </div>
                <div class="flex flex-col w-full pb-8">
                    <Label name="email">Email</Label>
                    <TextInput
                        name="email"
                        id="email"
                        type="email"
                        v-model="form.email"
                    />
                    <InputError :message="errors.email" />
                </div>
                <div class="flex justify-between gap-8 pb-8">
                    <div class="flex flex-col w-full">
                        <Label name="Form">Form</Label>
                        <multiselect
                            @select="onSelectForm"
                            @remove="onRemoveForm"
                            v-model="selectedForm"
                            label="title"
                            track-by="id"
                            :options="forms"
                            :close-on-select="true"
                        ></multiselect>
                        <InputError :message="errors.form_id" />
                    </div>
                    <div class="flex flex-col w-full">
                        <Label name="tag_ids">Tags</Label>
                        <multiselect
                            @select="onSelectTagList"
                            @remove="onRemoveTagList"
                            v-model="selectedTags"
                            label="title"
                            track-by="id"
                            :options="tags"
                            :close-on-select="true"
                            :multiple="true"
                        ></multiselect>
                        <InputError :message="errors.tag_ids" />
                    </div>
                </div>
                <div class="flex justify-end gap-6 pt-6">
                    <button
                        type="button"
                        class="transition-colors duration-300 hover:text-indigo-500"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="bg-indigo-500 text-white px-6 py-2 rounded-md transition-colors duration-300 hover:bg-indigo-600"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
.multiselect__tag {
    @apply bg-indigo-500;
}
.multiselect__tag-icon::after {
    color: white;
}
.multiselect__tags {
    @apply border-gray-300;
    min-height: 1rem;
    padding-block-start: 10px;
    padding-right: 40px;
}
.multiselect__option--highlight {
    @apply bg-indigo-500/10;
    outline: none;
    color: black;
}
.multiselect__option--highlight:after {
    content: attr(data-select);
    @apply bg-indigo-500;
    color: black;
}
.multiselect__option--selected {
    @apply bg-indigo-500/40;
    color: black;
}

.multiselect__option--selected:after {
    content: attr(data-selected);
    color: black;
}

.multiselect__option--selected.multiselect__option--highlight {
    @apply bg-indigo-400/50;
    color: black;
}

.multiselect__option--selected.multiselect__option--highlight:after {
    @apply bg-red-500;
    content: attr(data-deselect);
    color: black;
}
</style>
