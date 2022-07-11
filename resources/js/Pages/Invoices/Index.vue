<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import BreezeButton from '@/Components/Button.vue';
import DTable from '@/Components/Table/DTable.vue';
import StatusBadge from '../../Components/StatusBadge.vue';

const { invoices } = defineProps({
    invoices: Array
})

const columns = [
    {
        name: "id",
        label: "ID",
        sort: true,
        filter: true
    },
    {
        name: "created_at",
        label: "Date",
        sort: true,
        filter: true
    },
    {
        name: "customer_name",
        label: "Customer",
        sort: true,
    }, {
        name: "status",
        label: "Status",
        sort: true,
        filter: true,
    }, {
        name: "total",
        label: "Total",
    },
    {
        name: "balance",
        label: "Balance",
    },
    {
        name: "expense",
        label: "Expense",
    },
    {
        name: "profit",
        label: "Profit",
    },
    {
        name: "actions",
        label: "Actions",
    },
]

</script>

<template>

    <Head title="Invoices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoices
            </h2>
        </template>
        <template #header_action>
            <div>
                <Link :href="route('invoices.create')">
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
                        <DTable :data="invoices.data" :columns="columns" :meta="invoices.meta">
                            <template v-slot:customer_name="{ row }">
                                <div>
                                    {{ row.customer.name }}
                                </div>
                            </template>
                            <template v-slot:status="{ row }">
                                <div>
                                    <status-badge :status="row.status" />
                                </div>
                            </template>
                            <template v-slot:actions="{ row }">
                                <div class="flex gap-2 items-center">
                                    <BreezeButton :disabled="row.status != 'draft'"
                                        :class="{ 'opacity-25': row.status != 'draft' }">
                                        <Link v-if="row.status === 'draft'" :href="route('invoices.edit', row.id)">
                                        Edit
                                        </Link>
                                        <span v-else>Edit</span>

                                    </BreezeButton>
                                    <BreezeButton>
                                        <Link :href="route('invoices.show', row.id)">
                                        View
                                        </Link>
                                    </BreezeButton>
                                    <BreezeButton :disabled="row.status === 'paid' || row.status === 'cancelled'"
                                        :class="{ 'opacity-25': row.status === 'paid' || row.status === 'cancelled' }">
                                        <Link v-if="row.status != 'paid' && row.status != 'cancelled'"
                                            :href="route('payments.create_invoice', row.id)">
                                        Record payment
                                        </Link>
                                        <span v-else>Record Payment</span>
                                    </BreezeButton>
                                </div>
                            </template>

                        </DTable>
                    </div>
                </div>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
