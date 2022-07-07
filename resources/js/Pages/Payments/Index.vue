<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import BreezeButton from '@/Components/Button.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import DTable from '@/Components/Table/DTable.vue';


const { payments } = defineProps({
    payments: Array
})

const columns = [
    {
        name: 'id',
        label: 'Pay #',
        sort: true,
        filter: true

    },
    {
        name: 'amount',
        label: 'Amount',

    },
    {
        name: 'created_at',
        label: 'Date',
        filter: true

    },
    {
        name: 'paymentable_type',
        label: 'Towards',
    },
    {
        name: 'paymentable_id',
        label: 'For',
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
                Payments
            </h2>

        </template>
        <template #header_action>
            <div>
                <!-- <Link :href="route('payments.create_invoice')">
                <BreezeButton>
                    Create
                </BreezeButton>
                </Link> -->
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <DTable :data="payments.data" :columns="columns" :meta="{
                            last_page: payments.meta.last_page,
                        }">
                            <template v-slot:actions="{ row }">
                                <div>
                                    <Link :href="route('payments.show', row.id)">
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
