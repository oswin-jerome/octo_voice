<template>
    <div class="p-3 flex gap-4 items-center">
        <div class="flex flex-1 gap-1">
            <BreezeInput v-model="search" @focusout="runFilter" placeholder="Search..." type="text"
                class="mt-1 inline w-full text-sm flex-grow" required />
        </div>
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton class="">
                    <BreezeButton class="text-sm">
                        Add Filter
                    </BreezeButton>
                </MenuButton>
            </div>

            <transition enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0">
                <MenuItems
                    class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="px-1 py-1">
                        <MenuItem v-for="col in columns.filter((col) => col.filter)" :key="col" v-slot="{ active }"
                            @click="addFilter(col)">
                        <button :class="[
                            active ? 'bg-gray-200' : 'text-gray-900',
                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]">
                            {{ col.label }}
                        </button>
                        </MenuItem>
                    </div>

                </MenuItems>
            </transition>
        </Menu>
    </div>
    <div class="p-3 flex gap-4 " v-for="fil in Object.keys(filters)" :key="fil">

        <div class="flex-1">
            <BreezeLabel :value="fil"></BreezeLabel>
            <BreezeInput v-model="filters[fil]" placeholder="Search..." type="text"
                class="mt-1 inline w-full text-sm flex-grow" required />
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th v-for="col in columns" :key="col" scope="col" class="px-6 py-3 "
                    :class="col.sort ? ' cursor-pointer ' : ''" @click="handleSort(col)">
                    <div class="flex items-center gap-2">
                        <slot :name="'col_' + col.name">
                            {{ col.label }}
                        </slot>
                        <svg v-if="col.sort && sort_by == col.name" xmlns="http://www.w3.org/2000/svg"
                            :class="!col.name == sort_by ? '' : (sort_order ? 'transform rotate-180' : '')"
                            class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr v-for="(row) in data" :key="row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                <td v-for="(col) in columns" :key="col" scope="row"
                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    <slot :row="row" :col="col" :name="col.name">{{ row[col.name] }}</slot>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="p-3 text-center text-sm text-gray-500 flex flex-col items-center justify-center" v-if="data.length < 1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-28 w-28 text-gray-200" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
        </svg>
        <p>No data</p>
    </div>
    <div class="p-3 text-center text-sm text-gray-500">
        <ul class="flex gap-4 justify-end  w-full " v-if="data.length > 0">
            <li @click="() => {
                page = i
                runFilter()
            }" class="cursor-pointer text-blue-600" v-for="i in meta.last_page"
                :class="meta.current_page != i ? 'text-opacity-50' : ''" :key="i">
                <a>{{ i }}</a>
            </li>
        </ul>
    </div>

</template>

<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';

import { Inertia } from '@inertiajs/inertia';
import { ref, reactive } from '@vue/reactivity';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { filter } from 'minimatch';

const { columns, data, meta } = defineProps({
    columns: Array,
    data: Array,
    meta: Object
})

const search = ref("")
const page = ref(1)
const sort_by = ref("")
const sort_order = ref(true)
const filters = ref({})

onMounted(() => {
    search.value = route().params?.search ?? ''
})

const handleSort = (col) => {
    if (!col.sort) {
        return;
    }
    if (sort_by.value === col.name) {
        sort_order.value = !sort_order.value
    } else {

        sort_by.value = col.name
    }
    runFilter()
}

const addFilter = (col) => {
    console.log(col.name)
    filters.value[col.name] = ""
}

const runFilter = () => {

    var keys = Object.keys(filters.value)
    var final_filters = {}

    keys.forEach(function (key) {
        if (filters[key] != "") {
            final_filters["search_" + key] = filters.value[key]
            if (final_filters["search_" + key] == "") {
                delete final_filters["search_" + key]
            }
        } else {

        }
    })

    console.log(final_filters)

    var params = {
        search: search.value,
        page: page.value,
        sort_by: sort_by.value,
        sort_order: sort_order.value ? "asc" : "desc"
    }

    if (params.search === "") {
        delete params.search
    }
    if (params.sort_by === "") {
        delete params.sort_by
        delete params.sort_order
    }

    Inertia.get(route(route().current(), {
        ...params,
        ...final_filters
    }), {

    }, {
        preserveState: true,

        onProgress: () => {
            console.log(0)
        }
    })
}

</script>

<style>
</style>