<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Cash from './Cash.vue';
import CreditCard from './CreditCard.vue';
import BankTransfer from './BankTransfer.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaction Methods</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Cash class="max-w-xl"/>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreditCard class="max-w-xl"/>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <BankTransfer class="max-w-xl"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
