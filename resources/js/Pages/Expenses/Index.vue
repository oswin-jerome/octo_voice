<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import BreezeButton from '@/Components/Button.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import DTable from '@/Components/Table/DTable.vue';


const { expenses } = defineProps({
    expenses: Array
})

const columns = [
    {
        name: 'id',
        label: 'Pay #',
        sort: true,
        filter: true

    },
    {
        name: 'category_name',
        label: 'Category',
        sort: true,
        filter: true

    },
    {
        name: 'invoice_id',
        label: 'Invoice',
        sort: true,
        filter: true

    },
    {
        name: 'amount',
        label: 'Amount',
        sort: true,
        filter: true

    },
    {
        name: "actions",
        label: "Actions",
    }
]

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Expenses
            </h2>

        </template>
        <template #header_action>
            <div>
                <Link :href="route('expenses.create')">
                <BreezeButton>
                    Create
                </BreezeButton>
                </Link>
            </div>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <DTable :data="expenses.data" :columns="columns" :meta="{
                            last_page: expenses.meta.last_page,
                        }">
                            <template v-slot:actions="{ row }">
                                <div>
                                    <Link :href="route('expenses.show', row.id)">
                                    View
                                    </Link>
                                </div>
                            </template>
                            <template v-slot:category_name="{ row }">
                                <div>
                                    {{ row.category?.name }}
                                </div>
                            </template>
                            <template v-slot:invoice_id="{ row }">
                                <div v-if="row.invoice_id">
                                    <Link :href="route('invoices.show', row?.invoice_id)">
                                    {{ row?.invoice_id }}
                                    </Link>
                                </div>
                            </template>
                        </DTable>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
