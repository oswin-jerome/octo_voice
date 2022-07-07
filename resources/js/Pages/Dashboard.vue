<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
const { invoice_count, todays_payment, tax, invoice_sum } = defineProps({
    invoice_count: Number,
    invoice_sum: Number,
    todays_payment: Number,
    tax: Object
});

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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8   ">
                <div class="overflow-hidden  sm:rounded-lg ">
                    <div class="p-6 ">
                        <p class=" font-bold">
                            Todays report
                        </p>
                        <div class="flex mt-3 gap-4 w-full">
                            <div
                                class="bg-white shadow-lg p-4 rounded min-w-32 text-center flex flex-col justify-between">
                                <p></p>
                                <p class="font-bold text-5xl text-gray-600">
                                    Rs.{{ invoice_sum }}
                                </p>
                                <p class="text-sm">
                                    Invoice sum
                                </p>
                            </div>
                            <div
                                class="bg-white shadow-lg p-4 rounded min-w-32 text-center flex flex-col justify-between">
                                <p></p>
                                <p class="font-bold text-5xl text-gray-600">
                                    {{ invoice_count }}
                                </p>
                                <p class="text-sm">
                                    No. of Invoices
                                </p>
                            </div>
                            <div
                                class="bg-white shadow-lg p-4 rounded min-w-32 text-center flex flex-col justify-between">
                                <p></p>
                                <p class="font-bold text-5xl text-gray-600">
                                    Rs.{{ todays_payment }}
                                </p>
                                <p class="text-sm">
                                    Payment Received
                                </p>
                            </div>
                            <div
                                class="bg-white shadow-lg p-4 rounded min-w-32 text-center flex flex-col justify-between">
                                <p></p>
                                <p class="font-bold text-5xl text-gray-600">
                                    Rs.{{ tax.taxAmount }}
                                </p>
                                <p class="text-sm">
                                    Tax: {{ tax.Tax.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
