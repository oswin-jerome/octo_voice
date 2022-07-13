<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';


const { categories, errors } = defineProps({
    errors: {},
    categories: {
        type: Array,
        default: () => ([]),
    },
});

const form = useForm({
    name: '',
    description: '',
    code: '',
    serial_number: '',
    manufacturer: '',
    model: '',
    asset_category_id: '',
    purchase_date: ''

})

const submit = () => {
    form.post(route('assets.store'), {
        onFinish: () => form.reset(),
    });
}

</script>

<template>

    <Head title="Create Deliverable" />

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
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="">
                                    <BreezeLabel for="name" value="Name" />
                                    <BreezeInput v-model="form.name" id="name" type="text" class="mt-1 block w-full"
                                        required autocomplete="current-name" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="description" value="Description" />
                                    <BreezeInput v-model="form.description" id="description" type="text"
                                        class="mt-1 block w-full" required autocomplete="current-description" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="code" value="Code" />
                                    <BreezeInput v-model="form.code" id="code" type="text" class="mt-1 block w-full"
                                        required autocomplete="current-code" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="serial_number" value="Serial Number" />
                                    <BreezeInput v-model="form.serial_number" id="serial_number" type="text"
                                        class="mt-1 block w-full" required autocomplete="current-serial" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="manufacturer" value="Manufacturer" />
                                    <BreezeInput v-model="form.manufacturer" id="manufacturer" type="text"
                                        class="mt-1 block w-full" required autocomplete="current-serial" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="model" value="Model" />
                                    <BreezeInput v-model="form.model" id="model" type="text" class="mt-1 block w-full"
                                        required autocomplete="current-serial" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="purchase_date" value="Serial Number" />
                                    <BreezeInput v-model="form.purchase_date" id="purchase_date" type="date"
                                        class="mt-1 block w-full" required autocomplete="current-serial" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="asset_category_id" value="Category" />
                                    <select v-model="form.asset_category_id" id="asset_category_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="">Select a Category</option>
                                        <option v-for="category in categories" :value="category.id" :key="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
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
