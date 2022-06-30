<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { computed, defineProps } from 'vue'

const { deliverables } = defineProps({
    deliverables: Array,
    customers: Array,
})

const form = useForm({
    valid_till: '',
    customer_id: '',
    deliverables: [],
    discount: 0,
    discount_type: 'fixed',

})
const total = computed(
    () => {
        let t = form.deliverables.reduce((acc, cur) => acc + parseFloat(cur.price), 0)
        if (form.discount_type == 'fixed') {
            return t - parseFloat(form.discount);
        }
        return t - (t * parseFloat(form.discount) / 100);
    }
)

const discountedValue = computed(
    () => {
        let t = form.deliverables.reduce((acc, cur) => acc + parseFloat(cur.price), 0)
        if (form.discount_type == 'fixed') {
            return parseFloat(form.discount);
        }
        return (t * parseFloat(form.discount) / 100);
    }
)

const subtotal = computed(
    () => form.deliverables.reduce((acc, cur) => acc + parseFloat(cur.price), 0)
)
const submit = () => {
    form.transform((data) => ({
        ...data,
        deliverables: data.deliverables.map((deliverable) => (deliverable.id)),
    })).post(route('estimates.store'), {
        onFinish: () => form.reset(),

    });
}

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Estimate
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <BreezeLabel for="name" value="Valid Till" />
                                <BreezeInput v-model="form.valid_till" id="name" type="date" class="mt-1 block w-full"
                                    required autocomplete="current-name" />
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="description" value="Description" />
                                <BreezeInput v-model="form.description" id="description" type="text"
                                    class="mt-1 block w-full" required autocomplete="current-description" />
                            </div>
                            <div class="mt-4">
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
                            <div class="mt-4">
                                <BreezeLabel for="deliverable" value="Deliverable" />
                                <select v-model="form.deliverables" id="deliverable" multiple
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    required autocomplete="current-unit">
                                    <option value="">Select a deliverable</option>
                                    <option v-for="deliverable in deliverables" :value="deliverable"
                                        :key="deliverable.id">
                                        {{ deliverable.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="discount_type" value="discount_type" />
                                <select v-model="form.discount_type" id="discount_type"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    required autocomplete="current-unit">
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percentage</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="discount" value="Discount" />
                                <BreezeInput v-model="form.discount" id="discount" type="number"
                                    class="mt-1 block w-full" required autocomplete="current-discount" />
                            </div>

                            <p>Sub Total: {{ subtotal }}</p>
                            <p>Discount: {{ discountedValue }}</p>
                            <p>Total: {{ total }}</p>

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
