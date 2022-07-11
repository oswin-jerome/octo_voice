<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';

import { defineProps } from 'vue'

const { deliverable } = defineProps({
    deliverable: Object
})

const form = useForm({
    ...deliverable

})

const submit = () => {
    form.put(route('deliverables.update', deliverable.id), {
        onFinish: () => form.reset('name'),
    });
}

</script>

<template>

    <Head title="Edit Deliverable" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Deliverable
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput v-model="form.name" id="name" type="text" class="mt-1 block w-full"
                                    required autocomplete="current-name" />
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="description" value="Description" />
                                <BreezeInput v-model="form.description" id="description" type="text"
                                    class="mt-1 block w-full" required autocomplete="current-description" />
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="unit" value="Unit" />
                                <BreezeInput v-model="form.unit" id="unit" type="text" class="mt-1 block w-full"
                                    required autocomplete="current-unit" />
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="price" value="Price" />
                                <BreezeInput v-model="form.price" id="price" type="number" class="mt-1 block w-full"
                                    required autocomplete="current-price" />
                            </div>

                            <BreezeButton class=" mt-8" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Submit
                            </BreezeButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
