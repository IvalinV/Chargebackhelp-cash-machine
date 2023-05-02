<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    transfer_date: null,
    customer_name: null,
    account_number: null,
    amount: null,
    source: 'BankTransfer'
});

const createTransaction = () => {
    form.post(route('transaction.store'), {
        onSuccess: () => window.location = route('transaction.index'),
        onError: () => null,
        onFinish: () => form.reset(),
    });
};

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Bank Transfer</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create new trasanction using bank trnafer.
            </p>
        </header>

        <form @submit.prevent="createTransaction" class="mt-6 space-y-6">
            <div>
                <InputLabel for="transfer_date" value="Date" />

                <TextInput
                    id="transfer_date"
                    type="Date"
                    class="mt-1 block w-full"
                    v-model="form.transfer_date"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.transfer_date" />
            </div>

            <div>
                <InputLabel for="customer_name" value="Customer Name" />

                <TextInput
                    id="customer_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.customer_name"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.customer_name" />
            </div>

            <div>
                <InputLabel for="account_number" value="Account Number" />

                <TextInput
                    id="account_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.account_number"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.account_number" />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.amount"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.amount" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
