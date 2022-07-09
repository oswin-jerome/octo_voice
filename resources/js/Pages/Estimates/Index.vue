<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import BreezeButton from '@/Components/Button.vue';
import DTable from '@/Components/Table/DTable.vue';

const { estimates } = defineProps({
    estimates: Array
})

const columns = [
    {
        name: "id",
        label: "ID",
        sort: true,
        filter: true
    }, {
        name: "created_at",
        label: "Date",
        sort: true,
    },
    {
        name: "customer_name",
        label: "Customer",
        sort: true,
    }, {
        name: "total",
        label: "Total",
    }, {
        name: "valid_till",
        label: "Valid Till",
        sort: true,
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
                Estimates
            </h2>
        </template>
        <template #header_action>
            <div>
                <Link :href="route('estimates.create')">
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
                        <DTable :data="estimates.data" :columns="columns" :meta="estimates.meta">
                            <template v-slot:customer_name="{ row }">
                                <div>
                                    {{ row.customer.name }}
                                </div>
                            </template>
                            <template v-slot:actions="{ row }">
                                <div class="flex gap-4">
                                    <Link :href="route('estimates.edit', row.id)">
                                    Edit
                                    </Link>
                                    <Link :href="route('estimates.show', row.id)">
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
