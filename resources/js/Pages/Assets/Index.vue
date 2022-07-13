<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue"
import BreezeButton from '@/Components/Button.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import DTable from '@/Components/Table/DTable.vue';


const { assets } = defineProps({
    assets: Array
})

const columns = [
    {
        name: "id",
        label: "ID",
        sort: true,
        filter: true

    },
    {
        name: 'name',
        label: 'Name',
        sort: true,
        filter: true

    },
    {
        name: 'category_name',
        label: 'Category Name',

    },
    {
        name: 'current_status',
        label: 'Status',
        sort: true,
        filter: true
    },
    {
        name: 'user_name',
        label: 'Owner',
        sort: true,
        filter: true
    },
    {
        name: 'model',
        label: 'Model',
        sort: true,
        filter: true
    },
    {
        name: 'serial_number',
        label: 'Serial Number',
        sort: true,
        filter: true
    },
    // {
    //     name: 'actions',
    //     label: 'Actions',
    //     sort: false,
    //     filter: false
    // }
]

</script>

<template>

    <Head title="Assets" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Assets
            </h2>

        </template>
        <template #header_action>
            <div>
                <Link :href="route('assets.create')">
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
                        <DTable :data="assets.data" :columns="columns" :meta="{
                            last_page: assets.last_page,
                        }">

                            <template v-slot:description="{ row }">
                                <div class="">
                                    {{ row.description.slice(0, 30) }}...
                                </div>
                            </template>
                            <template v-slot:category_name="{ row }">
                                <div class="">
                                    {{ row.category?.name }}
                                </div>
                            </template>
                            <template v-slot:user_name="{ row }">
                                <div class="">
                                    {{ row.user?.name }}
                                </div>
                            </template>

                            <template v-slot:actions="{ row }">
                                <div class="">
                                    <Link :href="route('deliverables.edit', row.id)">
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
