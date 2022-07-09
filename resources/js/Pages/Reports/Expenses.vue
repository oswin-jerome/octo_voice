<template>
    <div>
        <Reports>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    <FromTo v-model:dates="dates" />
                    <a :href="route('reports.expenses_pdf', { type: reportType, ...dates, download: 'true' })">
                        <BreezeButton class="mt-4">
                            Download PDF
                        </BreezeButton>
                    </a>
                </div>
                <div class="col-span-2  hidden md:block">
                    <iframe class="w-full aspect-square"
                        :src="route('reports.expenses_pdf', { type: reportType, ...dates })" frameborder="0"></iframe>
                </div>
            </div>
        </Reports>
    </div>
</template>

<script setup>
import Reports from './Reports.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeLabel from '@/Components/Label.vue';
import { ref } from '@vue/reactivity';
import FromTo from './FromTo.vue';

const reportType = ref('category')
const dates = ref({})
</script>

<style>
</style>