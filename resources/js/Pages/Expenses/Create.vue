<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { defineProps, onMounted } from "vue"


const { categories } = defineProps({
    categories: Array,
})


const form = useForm({
    description: '',
    amount: '',
    expense_category_id: '',
    invoice_id: '',

})

onMounted(() => {
    if (route().params.invoice) {
        form.invoice_id = route().params.invoice
    }
})

const submit = () => {
    form.post(route('expenses.store'), {
        onFinish: () => form.reset(),
    });
}

</script>

<template>

    <Head title="Create Expense" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Expense
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p v-if="route().params.invoice"
                            class="text-sm text-amber-500 bg-amber-500/10 px-2 py-1 rounded-lg">You are add expense for
                            a
                            invoice
                            with #
                            {{
                                    route().params.invoice
                            }}</p>
                        <form @submit.prevent="submit" class="mt-4">
                            <div class="">
                                <BreezeLabel for="Category" value="Category" />
                                <select v-model="form.expense_category_id" id="Category"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    required autocomplete="current-unit">
                                    <option value="">Select a Category</option>
                                    <option v-for="category in categories" :value="category.id" :key="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="description" value="Description" />
                                <BreezeInput v-model="form.description" id="description" type="text"
                                    class="mt-1 block w-full" required autocomplete="current-description" />
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="amount" value="Amount" />
                                <BreezeInput v-model="form.amount" id="amount" type="number" class="mt-1 block w-full"
                                    required autocomplete="current-price" />
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
