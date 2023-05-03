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
    card_number: null,
    expiration_date: null,
    cardholder: null,
    cvv: null,
    amount: null,
    source: 'CreditCard'
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
            <h2 class="text-lg font-medium text-gray-900">Credit Card</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create new transanction using credit card.
            </p>
        </header>

        <form @submit.prevent="createTransaction" class="mt-6 space-y-6">
            <div>
                <InputLabel for="card_number" value="Card Number" />

                <TextInput
                    id="card_number"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.card_number"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.card_number" />
            </div>

            <div>
                <InputLabel for="expiration_date" value="Expiration Date" />

                <TextInput
                    id="expiration_date"
                    type="Date"
                    class="mt-1 block w-full"
                    v-model="form.expiration_date"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.expiration_date" />
            </div>

            <div>
                <InputLabel for="cardholder" value="Cardholder" />

                <TextInput
                    id="cardholder"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cardholder"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.cardholder" />
            </div>

            <div>
                <InputLabel for="cvv" value="CVV" />

                <TextInput
                    id="cvv"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.cvv"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.cvv" />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="number"
                    step="any"
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
