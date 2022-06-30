<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import BreezeButton from '@/Components/Button.vue';
import DTable from '@/Components/Table/DTable.vue';

const { invoices } = defineProps({
    invoices: Array
})

const columns = [
    {
        name: "id",
        label: "ID",
        sort: true,
        filter: true
    }, {
        name: "customer_name",
        label: "Customer",
        sort: true,
    }, {
        name: "total",
        label: "Total",
    },
    {
        name: "actions",
        label: "Actions",
    },
]

</script>

<template>

    <Head title="Dashboard" />

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
                            <template v-slot:actions="{ row }">
                                <div>
                                    <Link :href="route('invoices.show', row.id)">
                                    View
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
