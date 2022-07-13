<template>
    <div class="">
        <div class="flex gap-2 items-center">
            <BreezeLabel :for="db_key" :value="label" />
            <span class="text-xs text-green-500" v-if="isUpdated">Updated</span>
        </div>
        <BreezeInput @blur="save" v-if="type == 'text'" :id="db_key" v-model="form.value" type="text"
            class="mt-1 block w-full" required autocomplete="current-company_name" />
        <textarea v-if="type == 'textarea'" :id="db_key" v-model="form.value"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">

            </textarea>

    </div>
</template>

<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

const { value, db_key, label, type } = defineProps({
    value: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
        default: "undefined"
    },
    type: {
        type: String,
        required: false,
        default: "text"
    },
    db_key: {
        type: String,
        required: true,
    }
});

const isUpdated = ref(false)

const form = useForm({
    value: value,
    key: db_key,
})

const save = () => {
    if (!form.isDirty) {
        return;
    }
    form.put(route('settings.update', 1), {
        onSuccess: () => {
            console.log('success');
            isUpdated.value = true;
            setTimeout(() => {
                isUpdated.value = false;
            }, 2000);
        },
    });
}

</script>

<style>
</style>