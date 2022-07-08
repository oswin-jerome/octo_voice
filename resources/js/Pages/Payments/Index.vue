<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import BreezeButton from '@/Components/Button.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import DTable from '@/Components/Table/DTable.vue';
import moment from 'moment';

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
    // {
    //     name: 'paymentable_type',
    //     label: 'Towards',
    // },
    {
        name: 'paymentable_id',
        label: 'Towards',
    },
    {
        name: "actions",
        label: "Actions",
    },
]


const getHref = (row) => {
    if (row.paymentable_type == `App\\Models\\Invoice`) {
        return route('invoices.show', row.id)
    }
}

const formatDate = (date) => {
    return moment(date).format('DD MMM y hh:mm a')
}

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
                            <template v-slot:created_at="{ row }">
                                <div>
                                    {{ formatDate(row.created_at) }}
                                </div>
                            </template>
                            <template v-slot:paymentable_id="{ row }">
                                <div>
                                    <BreezeNavLink :href="getHref(row)">
                                        {{ row.paymentable_type.split('\\').pop() }} # {{ row.paymentable_id }}
                                    </BreezeNavLink>
                                </div>
                            </template>
                        </DTable>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
