<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul
                        class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                        <li class="">
                            <Link :href="route('reports.taxes', { taxes: '1,2' })" aria-current="page"
                                class="inline-block p-4 text-blue-600 bg-gray-100 active dark:bg-gray-800 dark:text-blue-500">
                            Taxes</Link>
                        </li>
                        <li class="">
                            <Link href="#"
                                class="inline-block p-4 hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                            Dashboard</Link>
                        </li>
                        <li class="">
                            <Link href="#"
                                class="inline-block p-4 hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                            Settings</Link>
                        </li>
                    </ul>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <slot></slot>
                    </div>
                </div>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
