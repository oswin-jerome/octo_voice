<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const { invoice_id, invoice } = defineProps({
    invoice_id: Number,
    invoice: Object
})

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <ResponsiveNavLink v-if="invoice.status == 'draft'"
                :href="route('invoices.changestatus', [invoice_id, 'sent'])" method="put" as="button">
                Mark as Sent
            </ResponsiveNavLink>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 bg-white border-b border-gray-200">
                        <iframe class="w-full aspect-square" :src="route('invoices.pdf', invoice_id)"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
