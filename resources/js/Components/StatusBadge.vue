
<template>
    <div class="flex justify-start">
        <div :class="getClasses(status)" class="px-2 capitalize rounded">
            {{ status }}
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue"
const { status } = defineProps({
    status: Object
})

const getClasses = (status) => {
    switch (status) {
        case "pending":
            return "bg-yellow-400 text-white"
        case "draft":
            return "bg-amber-500/20 text-amber-500"
        case "paid":
            return "bg-green-500/2- text-green-500"
        case "cancelled":
            return "bg-red-500/20 text-red-500"
        default:
            return "bg-gray-400 text-white"
    }
}

</script>

<style>
</style>