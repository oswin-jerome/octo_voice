<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';


const { assets, errors } = defineProps({
    errors: {},
    assets: {
        type: Array,
        default: () => ([]),
    },
    users: {
        type: Array,
        default: () => ([]),
    },
});

const form = useForm({
    description: '',
    user_id: '',
    asset_id: '',
    type: 'checkout',
    purpose: '',

})

const submit = () => {
    form.post(route('assets.checkout'), {
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
                                    <BreezeLabel for="description" value="Description" />
                                    <BreezeInput v-model="form.description" id="description" type="text"
                                        class="mt-1 block w-full" required autocomplete="current-description" />
                                </div>

                                <div class="">
                                    <BreezeLabel for="asset_id" value="Asset" />
                                    <select v-model="form.asset_id" id="asset_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="">Select a Asset</option>
                                        <option v-for="asset in assets" :value="asset.id" :key="asset.id">
                                            {{ asset.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="">
                                    <BreezeLabel for="user_id" value="Staff" />
                                    <select v-model="form.user_id" id="user_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="">Select a User</option>
                                        <option v-for="user in users" :value="user.id" :key="user.id">
                                            {{ user.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="">
                                    <BreezeLabel for="purpose" value="Purpose" />
                                    <select v-model="form.purpose" id="purpose"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="general">General</option>
                                        <option value="repair">Repair</option>
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
