<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import BreezeButton from '@/Components/Button.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import DTable from '@/Components/Table/DTable.vue';


const { deliverables } = defineProps({
    deliverables: Array
})

const columns = [
    {
        name: 'name',
        label: 'Name',
        sort: true,
        filter: true

    },
    {
        name: 'description',
        label: 'Description',

    },
    {
        name: 'unit',
        label: 'Unit',
        filter: true

    },
    {
        name: 'price',
        label: 'Price',
        filter: true

    },
]

</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Deliverables
            </h2>

        </template>
        <template #header_action>
            <div>
                <Link :href="route('deliverables.create')">
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
                        <DTable :data="deliverables.data" :columns="columns" :meta="{
                            last_page: deliverables.last_page,
                        }">

                        </DTable>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
