<script setup>
import {ShoppingCartIcon, BanknotesIcon} from "@heroicons/vue/24/outline/index.js";

defineProps({
    price: Number,
    name: String,
    date: String,
    time: String,
    isDebit: Boolean,
})
</script>

<template>
    <div class="flex gap-x-4">
        <div v-if="isDebit">
            <ShoppingCartIcon class="h-10 w-10"/>
        </div>
        <div v-else>
            <BanknotesIcon class="h-10 w-10 text-green-600"/>
        </div>
        <div class="min-w-0 flex-auto">
            <p class="text-lg font-bold leading-6 text-gray-900">${{ price }}</p>
            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ name }}</p>
        </div>
    </div>
    <div class="sm:flex sm:flex-col sm:items-end">
        <p class="mt-1 text-xs leading-5 text-gray-500">
            <time :datetime="date">{{ time }}</time>
        </p>
    </div>
</template>
