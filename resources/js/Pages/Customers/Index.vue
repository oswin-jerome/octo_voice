
<template>

    <Head title="Customers" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customers
            </h2>
        </template>

        <template #header_action>
            <div>
                <Link :href="route('customers.create')">
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

                        <DTable :data="customers.data" :columns="columns" :meta="{
                            last_page: customers.last_page,
                        }">
                            <template v-slot:actions="{ row }">
                                <div>
                                    <Link :href="route('customers.edit', row.id)">
                                    <BreezeButton>
                                        Edit
                                    </BreezeButton>
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

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import DTable from '@/Components/Table/DTable.vue';
import BreezeButton from '@/Components/Button.vue';
const { customers } = defineProps({
    customers: Array
})

const columns = [
    {
        name: "name",
        label: "Name",
        sort: true,
        filter: true
    },
    {
        name: "email",
        label: "Email",
        sort: true,
        filter: true
    },
    {
        name: "phone",
        label: "Phone",
        sort: true,
        filter: true
    },
    {
        name: "actions",
        label: "Actions",
    },
]

</script>
