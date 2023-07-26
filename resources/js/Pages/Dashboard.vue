<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Transaction from "@/Components/Transaction.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";



defineProps({
    name: String,
    date: String,
    budget: Number,
    total_expenses: Number,
    recent_transactions: Array,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome, {{name}}!</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-between p-6 shadow ">
                    <div>
                        <div>
                            {{date}}
                        </div>

                        <div class="py-1">
                            Budget: <strong>${{budget}}</strong>
                        </div>

                        <div class="">
                            Total expenses: <strong>${{total_expenses}}</strong>
                        </div>
                    </div>
                    <div class="border-r-2"></div>
                    <div>
<!--                        TODO: Add Chart-->
                        Chart will be added later
                    </div>
                </div>

                <div class="p-4 text-center mx-auto" >
                    <Link :href="route('expense.index')">
                        <PrimaryButton class="bg-green-700 hover:bg-green-600 active:bg-green-700 focus:bg-green-700" type="button" @click="">Add Expense</PrimaryButton>
                    </Link>
                    <!--                    Todo: Add modification button-->
                    <!--                    <SecondaryButton class="m-2" type="button" @click="">Modify Expense</SecondaryButton>-->
                </div>

                <div class="p-4 shadow">
                    <div class="font-bold text-xl py-2">
                        YOUR RECENT TRANSACTIONS :
                    </div>
                    <div>
                        <ul role="list" class="divide-y divide-gray-100">
                            <li v-for="transaction in recent_transactions" :key="transaction.id" class="flex justify-between gap-x-6 py-5">
                                <Transaction :price="transaction.price" :name="transaction.description" :date="transaction.created_at" :time="transaction.time" :isDebit="transaction.is_spent"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
