<template>
    <div class="mt-4 grid gap-3">
        <div class="">
            <BreezeLabel for="Customer" value="Date " />
            <select @change="selectDate($event.target.value)" v-model="period" id="Customer"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                required autocomplete="current-unit">
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
                <option value="last_15_days">Last 15 days</option>
                <option value="last_30_days">Last 30 days</option>
                <option value="last_60_days">Last 60 days</option>
                <option value="last_90_days">Last 90 days</option>
                <option value="custom">Custom</option>

            </select>
        </div>
        <div class="flex gap-4 " v-if="period == 'custom'">
            <div>
                <BreezeLabel for="from" value="From" />
                <BreezeInput @change="update" v-model="data.from" id="from" type="date" class="mt-1 block w-full"
                    required autofocus autocomplete="username" />
            </div>
            <div>
                <BreezeLabel for="to" value="To" />
                <BreezeInput @change="update" v-model="data.to" id="to" type="date" class="mt-1 block w-full" required
                    autofocus autocomplete="username" />
            </div>

        </div>
    </div>
</template>

<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import moment from 'moment';
import { defineProps, defineEmits, ref, onMounted } from 'vue'
const { dates } = defineProps({
    dates: Object
});

const data = ref({
    from: dates?.from,
    to: dates?.to
})

const period = ref('')

const emit = defineEmits(['update:dates'])

onMounted(() => {
    data.value.from = moment().add(-0, 'days').format('YYYY-MM-DD')
    data.value.to = moment().format('YYYY-MM-DD')
    period.value = 'today'
    update()
})

const selectDate = (period) => {
    if (period == "today") {
        data.value.from = moment().add(-0, 'days').format('YYYY-MM-DD')
        data.value.to = moment().format('YYYY-MM-DD')
    }
    if (period == "yesterday") {
        data.value.from = moment().add(-1, 'days').format('YYYY-MM-DD')
        data.value.to = moment().add(-1, 'days').format('YYYY-MM-DD')
    }
    if (period == "last_15_days") {
        data.value.from = moment().add(-15, 'days').format('YYYY-MM-DD')
        data.value.to = moment().format('YYYY-MM-DD')
    }
    if (period == "last_30_days") {
        data.value.from = moment().add(-30, 'days').format('YYYY-MM-DD')
        data.value.to = moment().format('YYYY-MM-DD')
    }
    if (period == "last_60_days") {
        data.value.from = moment().add(-60, 'days').format('YYYY-MM-DD')
        data.value.to = moment().format('YYYY-MM-DD')
    }
    if (period == "last_90_days") {
        data.value.from = moment().add(-90, 'days').format('YYYY-MM-DD')
        data.value.to = moment().format('YYYY-MM-DD')
    }

    update()
}

const update = () => {
    console.log(data)
    emit('update:dates', {
        from: data.value.from,
        to: data.value.to
    })
}
</script>

<style>
</style>