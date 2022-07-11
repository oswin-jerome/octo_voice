<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { computed, defineProps, ref } from 'vue'

const { deliverables, taxes, customers, errors } = defineProps({
    deliverables: Array,
    customers: Array,
    taxes: Array,
    errors: Object,
})

const form = useForm({
    customer_id: '',
    deliverables: [],
    discount: 0,
    discount_type: 'fixed',
    taxes: [],

})

const getItemTotal = () => {
    let t = form.deliverables.reduce((acc, cur) => acc + (parseFloat(cur.price) * parseFloat(cur.qty)), 0)
    return t;
}

const total = computed(
    () => {
        let t = getItemTotal()
        // let taxPercentage = form.taxes.reduce((acc, cur) => acc + (parseFloat(cur.value)), 0)
        // // alert(taxPercentage)
        // // TODO: fix multi tax logic
        // if (form.taxes.length > 0 && form.taxes[0].type === 'percentage') {
        //     // t = t + (t * taxPercentage)
        //     t = t + (t * (taxPercentage / 100))
        // }

        var taxAmount = getTaxesValue();

        var discountAmount = getDiscountValue();
        return parseFloat(t + taxAmount - discountAmount).toFixed(2);
    }
)

const getTaxesValue = () => {
    let t = getItemTotal()
    var discountAmount = getDiscountValue();
    t = t - discountAmount;
    let taxPercentage = form.taxes.reduce((acc, cur) => acc + (parseFloat(cur.value)), 0)
    // TODO: fix multi tax logic
    if (form.taxes.length > 0 && form.taxes[0].type === 'percentage') {
        // t = t + (t * taxPercentage)
        return (t * (taxPercentage / 100))
    }
    return 0;
}

const getDiscountValue = () => {
    let t = getItemTotal()
    if (form.discount_type == 'fixed') {
        return parseFloat(form.discount);
    }
    return (t * parseFloat(form.discount) / 100);
}

const discountedValue = computed(
    () => {
        return getDiscountValue();
    }
)

const subtotal = computed(
    () => getItemTotal()
)
const submit = () => {
    form.transform((data) => ({
        ...data,
        deliverables: data.deliverables.map((deliverable) => ({
            deliverable_id: deliverable.id,
            quantity: deliverable.qty,
            amount_per_unit: deliverable.price
        })),
        taxes: data.taxes.map((tax) => ({
            tax_id: tax.id,
        })),
    })).post(route('invoices.store'), {
        preserveState: true,
        onSuccess: () => form.reset(),

    });
}

const currentDeliverable = ref(null)
const currentQuantity = ref(1)

const addItem = () => {
    console.log(currentDeliverable.value)
    form.deliverables.push({
        ...currentDeliverable.value,
        qty: currentQuantity.value,
        total: currentQuantity.value * currentDeliverable.value.price,
    });
}

const removeItem = (ind) => {
    form.deliverables.splice(ind, 1);
}

</script>

<template>

    <Head title="Create Invoice" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Invoice
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 bg-white border-b border-gray-200  grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="">
                            <BreezeLabel for="Customer" value="Customer" />
                            <select v-model="form.customer_id" id="Customer"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                required autocomplete="current-unit">
                                <option value="">Select a customer</option>
                                <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                                    {{ customer.name }}
                                </option>
                            </select>
                            <p v-if="errors['customer_id']"
                                class="text-red-500 bg-red-500/10 rounded-lg px-2 py-1 mt-2 text-xs">
                                {{ errors['customer_id'] }}
                            </p>
                        </div>
                        <div class="col-span-2">
                            <BreezeLabel for="description" value="Description" />
                            <BreezeInput v-model="form.description" id="description" type="text"
                                class="mt-1 block w-full" required autocomplete="current-description" />
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="addItem">
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="">
                                    <BreezeLabel for="deliverable" value="Deliverable" />
                                    <select v-model="currentDeliverable" id="deliverable"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        required autocomplete="current-unit">
                                        <option value="">Select a deliverable</option>
                                        <option v-for="deliverable in deliverables" :value="deliverable"
                                            :key="deliverable.id">
                                            {{ deliverable.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="">
                                    <BreezeLabel for="qty" value="Quantity" />
                                    <BreezeInput v-model="currentQuantity" id="qty" type="text"
                                        class="mt-1 block w-full" required autocomplete="current-qty" />
                                </div>
                                <div class="flex flex-col justify-center items-end">
                                    <BreezeLabel class="opacity-0" for="qty" value="Quantity" />

                                    <BreezeButton class="" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Submit
                                    </BreezeButton>
                                </div>
                            </div>

                        </form>
                        <p v-if="errors['deliverables']"
                            class="text-red-500 bg-red-500/10 rounded-lg px-2 py-1 mt-2 text-xs">
                            {{ errors['deliverables'] }}
                        </p>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">Deliverable</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Quantity</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(deliverable, index) in form.deliverables " :key="deliverable">
                                    <td class="px-4 py-3">{{ deliverable.name }}</td>
                                    <td class="px-4 py-3">{{ deliverable.price }}</td>
                                    <td class="px-4 py-3">{{ deliverable.qty }}</td>
                                    <td class="px-4 py-3">{{ parseFloat(deliverable.total)
                                    }}</td>
                                    <td class="px-4 py-3">
                                        <button @click="removeItem(index)">
                                            remove
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-4">
                    <div class="col-span-3 p-3">

                        <p>Sub Total: {{ subtotal }}</p>
                        <p>Discount: {{ discountedValue }}</p>
                        <p>Sub Total - Discount: {{ subtotal - discountedValue }}</p>
                        <p v-for="tax in form.taxes" :key="tax">{{ tax.name }}: {{ (subtotal - discountedValue) *
                                (tax.value / 100)
                        }} <span class="text-xs">{{
        tax.value
}}%<span class="text-xs"> of {{ subtotal - discountedValue }}</span></span>
                        </p>
                        <p>Total (<span class="text-xs">sub total - tax - discount</span>): {{ total }}</p>

                    </div>
                    <div class="p-6 bg-white border-b border-gray-200  ">
                        <div class="">
                            <BreezeLabel for="discount_type" value="discount_type" />
                            <select v-model="form.discount_type" id="discount_type"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                required autocomplete="current-unit">
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percentage</option>
                            </select>
                        </div>
                        <div class="">
                            <BreezeLabel for="discount" value="Discount" />
                            <BreezeInput v-model="form.discount" id="discount" type="number" class="mt-1 block w-full"
                                required autocomplete="current-discount" />
                        </div>
                        <div class="">
                            <BreezeLabel for="taxes" value="taxes" />
                            <select v-model="form.taxes" id="taxes" multiple
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                required autocomplete="current-unit">
                                <option value=""></option>
                                <option v-for="tax in taxes" :key="tax" :value="tax">{{ tax.name }} @{{ tax.value
                                }}<span v-if="tax.type == 'percentage'">%</span>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <BreezeButton @click="submit" class=" mt-8" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Submit
                </BreezeButton>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
