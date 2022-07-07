<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { defineProps } from "vue"

const { invoice, customers } = defineProps({
    invoice: Object,
    customers: Array
})


const form = useForm({
    description: 'test',
    reference: 'test',
    customer_id: invoice.customer_id,
    invoice_id: invoice.id,
    payment_method: "cash",
    amount: invoice.balance,

})

const submit = () => {
    form.post(route('payments.store'), {
        onFinish: () => form.reset(),
    });
}

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Record Payment
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="">
                                    <BreezeLabel for="customer_id" value="Customer" />
                                    <select v-model="form.customer_id" id="customer_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value=""></option>
                                        <option v-for="customer in customers" :key="customer" :value="customer.id">
                                            {{ customer.name }}</option>
                                    </select>
                                </div>
                                <div class="">
                                    <BreezeLabel for=" invoice" value="Invoice" />
                                    <BreezeInput id="invoice" type="text" v-model="form.invoice_id" readonly
                                        class="mt-1 block w-full" required autocomplete="current-invoice" />
                                </div>
                                <div class="">
                                    <BreezeLabel for="payment_method" value="Payment Method" />
                                    <select v-model="form.payment_method" id="payment_method"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="">
                                    <BreezeLabel for=" amount" value="Amount" />
                                    <BreezeInput id="amount" type="text" v-model="form.amount" class="mt-1 block w-full"
                                        required autocomplete="current-invoice" />
                                </div>
                                <div class="">
                                    <BreezeLabel for=" reference" value="Reference" />
                                    <BreezeInput id="reference" type="text" class="mt-1 block w-full" required
                                        v-model="form.reference" autocomplete="current-reference" />
                                </div>
                                <div class="">
                                    <BreezeLabel for=" description" value="Description" />
                                    <BreezeInput id="description" type="text" v-model="form.description"
                                        class="mt-1 block w-full" required autocomplete="current-description" />
                                </div>
                            </div>
                            <BreezeButton :disabled="invoice.balance <= 0"
                                :class="{ 'opacity-25': invoice.balance <= 0 }" class=" mt-8">
                                Submit
                            </BreezeButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
