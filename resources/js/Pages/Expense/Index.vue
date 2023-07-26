<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";

const types = [
    {id: 0, name: 'Income'},
    {id: 1, name: 'Expense'},
]


const form = useForm({
    name: '',
    price: '',
    type: '',
});


const submit = () => {
    form.post(route('expense.store'), {
        onFinish: () => form.reset('name', 'price', 'type'),
    });
};
</script>

<template>

    <Head title="Add Expense" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Expense</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" @submit.prevent="submit">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Expense Name</label>
                            <div class="mt-2">
                                <input id="name" v-model="form.name" name="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="text" v-model="form.price" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00" />
                            </div>
                        </div>

                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select type</label>
                            <select v-model="form.type" id="type" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" selected disabled>Select a type</option>
                                <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>

                        <div>
                            <PrimaryButton type="submit">Add</PrimaryButton>
                            <Link :href="route('dashboard')">
                                <SecondaryButton type="cancel" class="ml-2">Cancel</SecondaryButton>
                            </Link>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
