<template>
    <div>
        <Reports>
            <div>
                <ul class="flex gap-4">
                    <li @click="toggleSelectedTax(tax)" class="px-5 py-2 rounded-full shadow text-sm cursor-pointer"
                        :class="{
                            'text-white bg-blue-500': selectedTaxes.find(t => t.id == tax.id),
                            'text-blue-500': !selectedTaxes.find(t => t.id == tax.id)
                        }" v-for="tax in taxes" :key="tax">{{
        tax.name
}}</li>
                </ul>
            </div>
            <div class="flex mt-2 gap-4">
                <div>
                    <BreezeLabel for="from" value="From" />
                    <BreezeInput @change="updateUI" v-model="fromDate" id="from" type="date" class="mt-1 block w-full"
                        required autofocus autocomplete="username" />
                </div>
                <div>
                    <BreezeLabel for="to" value="To" />
                    <BreezeInput @change="updateUI" v-model="toDate" id="to" type="date" class="mt-1 block w-full"
                        required autofocus autocomplete="username" />
                </div>
                <div class="">
                    <BreezeLabel for="Customer" value="Customer" />
                    <select @change="selectDate($event.target.value)" id="Customer"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        required autocomplete="current-unit">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last_15_days">Last 15 days</option>
                        <option value="last_30_days">Last 30 days</option>
                        <option value="last_60_days">Last 60 days</option>
                        <option value="last_90_days">Last 90 days</option>

                    </select>
                </div>
            </div>
            <br />
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 ">Invoice #</th>
                        <th scope="col" class="px-6 py-3 ">Total Amount</th>
                        <th scope="col" class="px-6 py-3 ">Taxes Applied</th>
                        <th scope="col" class="px-6 py-3 ">Total Tax Amount</th>
                        <th v-for="tax in selectedTaxes" :key="tax" scope="col" class="px-6 py-3 ">{{ tax.name
                        }}</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data.data" :key="item"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ item.id }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ item.total_amount }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ item.taxes.map(t => t.name).toString() }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ item.tax_amount }}
                        </td>
                        <th v-for="tax in selectedTaxes" :key="tax" scope="col" class="px-6 py-3 ">
                            {{ item['tax_' + tax.id] }}
                        </th>

                    </tr>
                </tbody>
                <tfoot class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-bold"></th>
                        <th scope="col" class="px-6 py-3 font-bold">{{ data.data.reduce((a, c) => a +
                                c.total_amount, 0)
                        }}</th>
                        <th scope="col" class="px-6 py-3 "></th>
                        <th scope="col" class="px-6 py-3 ">{{ data.data.reduce((a, c) => a + c.tax_amount, 0) }}
                        </th>
                        <th v-for="tax in selectedTaxes" :key="tax" scope="col" class="px-6 py-3 ">
                            {{ data.data.reduce((a, c) => a + c['tax_' + tax.id], 0) }}</th>
                    </tr>
                </tfoot>
            </table>
        </Reports>
    </div>
</template>

<script setup>
import Reports from './Reports.vue';
import { defineProps, onMounted, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import moment from 'moment'

const { taxes, data, from, to } = defineProps({
    taxes: Array,
    data: Object,
    from: Date,
    to: Date
})

const selectedTaxes = ref([])
const fromDate = ref(from)
const toDate = ref(to)

onMounted(() => {
    Inertia.get(route(route().current()), {
        taxes: selectedTaxes.value.map((tax) => tax.id).join(','),
        from: fromDate.value,
        to: toDate.value
    }, {
        preserveState: true
    });
})

const toggleSelectedTax = (tax) => {
    const index = selectedTaxes.value.find(t => t.id == tax.id);
    console.log(index)
    if (!index) {
        selectedTaxes.value.push(tax)
    } else {
        selectedTaxes.value.splice(selectedTaxes.value.indexOf(index), 1)
    }
    updateUI()

}

const updateUI = () => {
    Inertia.get(route(route().current()), {
        taxes: selectedTaxes.value.map((tax) => tax.id).join(','),
        from: fromDate.value,
        to: toDate.value
    }, {
        preserveState: true
    });
}

const selectDate = (period) => {
    if (period == "today") {
        fromDate.value = moment().add(-0, 'days').format('YYYY-MM-DD')
        toDate.value = moment().format('YYYY-MM-DD')
    }
    if (period == "yesterday") {
        fromDate.value = moment().add(-1, 'days').format('YYYY-MM-DD')
        toDate.value = moment().add(-1, 'days').format('YYYY-MM-DD')
    }
    if (period == "last_15_days") {
        fromDate.value = moment().add(-15, 'days').format('YYYY-MM-DD')
        toDate.value = moment().format('YYYY-MM-DD')
    }
    if (period == "last_30_days") {
        fromDate.value = moment().add(-30, 'days').format('YYYY-MM-DD')
        toDate.value = moment().format('YYYY-MM-DD')
    }
    if (period == "last_60_days") {
        fromDate.value = moment().add(-60, 'days').format('YYYY-MM-DD')
        toDate.value = moment().format('YYYY-MM-DD')
    }
    if (period == "last_90_days") {
        fromDate.value = moment().add(-90, 'days').format('YYYY-MM-DD')
        toDate.value = moment().format('YYYY-MM-DD')
    }

    updateUI()
}

</script>

<style>
</style>