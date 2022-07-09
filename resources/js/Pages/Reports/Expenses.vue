<template>
    <div>
        <Reports>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h1 class="mb-5">Config</h1>
                    <div class="">
                        <BreezeLabel for="Customer" value="Report Type " />
                        <select id="Customer" v-model="reportType"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            required autocomplete="current-unit">
                            <option value="category">Category</option>
                            <option value="date">Date</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>

                        </select>
                    </div>
                    <div class="flex gap-4 mt-4">
                        <div>
                            <BreezeLabel for="from" value="From" />
                            <BreezeInput @change="updateUI" v-model="fromDate" id="from" type="date"
                                class="mt-1 block w-full" required autofocus autocomplete="username" />
                        </div>
                        <div>
                            <BreezeLabel for="to" value="To" />
                            <BreezeInput @change="updateUI" v-model="toDate" id="to" type="date"
                                class="mt-1 block w-full" required autofocus autocomplete="username" />
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <iframe class="w-full aspect-square" :src="route('reports.expenses_pdf', { type: reportType })"
                        frameborder="0"></iframe>
                </div>
            </div>
        </Reports>
    </div>
</template>

<script setup>
import Reports from './Reports.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { ref } from '@vue/reactivity';

const reportType = ref('category')

</script>

<style>
</style>