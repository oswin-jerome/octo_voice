<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { defineProps } from 'vue';
import SettingsField from '@/Components/SettingsField.vue';
const { settings } = defineProps({
    settings: {
        type: Object,
        required: true,
    },
});

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-bold text-lg text-gray-800 mb-5">General</h2>
                        <div class="grid gap-4">
                            <SettingsField :value="settings.company_name" db_key="company_name" label="Company Name" />
                            <SettingsField :value="settings.company_email" db_key="company_email"
                                label="Company Email" />
                            <SettingsField :value="settings.company_phone" db_key="company_phone"
                                label="Company Phone" />
                            <SettingsField :value="settings.company_address" db_key="company_address" type="textarea"
                                label="Company Address" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
