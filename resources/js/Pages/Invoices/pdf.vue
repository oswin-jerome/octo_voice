<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ButtonVue from '@/Components/Button.vue';

const { invoice_id, invoice, payments } = defineProps({
    invoice_id: Number,
    invoice: Object,
    payments: Array,
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

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div class="py-4 flex gap-4">
                        <ButtonVue v-if="invoice.status == 'draft'">
                            <Link v-if="invoice.status == 'draft'"
                                :href="route('invoices.changestatus', [invoice_id, 'mark_sent'])" method="put"
                                as="button">
                            Mark as Sent
                            </Link>
                        </ButtonVue>
                        <ButtonVue>
                            <Link :href="route('invoices.changestatus', [invoice_id, 'sent'])" method="put" as="button">
                            Send Invoice
                            </Link>
                        </ButtonVue>
                        <ButtonVue
                            v-if="(invoice.status != 'paid' && invoice.status != 'partially_paid') && invoice.status != 'cancelled'"
                            class="bg-red-500">
                            <Link :href="route('invoices.changestatus', [invoice_id, 'cancelled'])" method="put"
                                as="button">
                            Cancel Invoice
                            </Link>
                        </ButtonVue>
                    </div>
                    <h3 class="font-bold">Payments</h3>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 ">#</th>
                                <th class="px-6 py-3 ">Amount</th>
                                <!-- <th class="px-6 py-3 ">Date</th> -->
                                <th class="px-6 py-3 ">Mode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pay in payments" :key="pay">
                                <td class="px-6 py-3 ">{{ pay.id }}</td>
                                <td class="px-6 py-3 ">{{ pay.amount }}</td>
                                <!-- <td class="px-6 py-3 ">{{ pay.created_at }}</td> -->
                                <td class="px-6 py-3 ">{{ pay.payment_method }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <iframe class="w-full aspect-square" :src="route('invoices.pdf', invoice_id)"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
