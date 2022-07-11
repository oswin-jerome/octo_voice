<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { computed, defineProps, ref } from 'vue'

const { deliverables, customers, taxes, estimate } = defineProps({
    deliverables: Array,
    customers: Array,
    taxes: Array,
    estimate: Object,
})

const form = useForm({
    valid_till: estimate.valid_till,
    customer_id: estimate.customer_id,
    deliverables: [
        ...estimate.deliverables.map((del) => {
            return {
                ...del,
                qty: del.pivot.quantity,
                total: del.pivot.amount_per_unit * del.pivot.quantity,
            }
        })
    ],
    discount: estimate.discount,
    discount_type: estimate.discount_type,
    taxes: [
        ...estimate.taxes
    ],

})
const total = computed(
    () => {
        let t = form.deliverables.reduce((acc, cur) => acc + (parseFloat(cur.price) * parseFloat(cur.qty)), 0)
        let taxPercentage = form.taxes.reduce((acc, cur) => acc + (parseFloat(cur.value)), 0)
        // alert(taxPercentage)
        // TODO: fix multi tax logic
        if (form.taxes.length > 0 && form.taxes[0].type === 'percentage') {
            // t = t + (t * taxPercentage)
            t = t + (t * (taxPercentage / 100))
        }

        if (form.discount_type == 'fixed') {
            return t - parseFloat(form.discount);
        }
        return t - (t * parseFloat(form.discount) / 100);
    }
)

const discountedValue = computed(
    () => {
        let t = form.deliverables.reduce((acc, cur) => acc + (parseFloat(cur.price) * parseFloat(cur.qty)), 0)
        if (form.discount_type == 'fixed') {
            return parseFloat(form.discount);
        }
        return (t * parseFloat(form.discount) / 100);
    }
)

const subtotal = computed(
    () => form.deliverables.reduce((acc, cur) => acc + (parseFloat(cur.price) * parseFloat(cur.qty)), 0)
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
    })).put(route('estimates.update', estimate.id), {
        onFinish: () => form.reset(),

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

    <Head title="Edit Estimate" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Estimate
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200  grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="">
                            <BreezeLabel for="valid_till" value="Valid Till" />
                            <BreezeInput v-model="form.valid_till" id="valid_till" type="date" class="mt-1 block w-full"
                                required autocomplete="current-valid_till" />
                        </div>
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
                                    <td class="px-4 py-3">{{ deliverable.qty }} {{ deliverable.unit }}</td>
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
                        <p>Total: {{ total }}</p>

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
                                <option v-for="tax in taxes" :key="tax" :value="tax"
                                    :selected="form.taxes.find((t) => t.id === tax.id)">{{ tax.name }} @{{ tax.value
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
