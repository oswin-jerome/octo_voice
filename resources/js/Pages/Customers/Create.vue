<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';

const form = useForm({
    name: '',
    email: '',

})

const submit = () => {
    form.post(route('customers.store'), {
        onFinish: () => form.reset('name'),
    });
}

</script>

<template>

    <Head title="Create customer" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Customer
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
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput v-model="form.email" id="email" type="email" class="mt-1 block w-full"
                                    required autocomplete="current-email" />
                            </div>

                            <BreezeButton class="mt-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Create
                            </BreezeButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
