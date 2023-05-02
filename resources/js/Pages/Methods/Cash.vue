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
    one_bills: null,
    five_bills: null,
    ten_bills: null,
    fifty_bills: null,
    hundred_bills: null,
    source: 'Cash'
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
            <h2 class="text-lg font-medium text-gray-900">Cash</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create new trasanction using cash.
            </p>
        </header>

        <form @submit.prevent="createTransaction" class="mt-6 space-y-6">
            <div>
                <InputLabel for="one_bills" value="1 Bills" />

                <TextInput
                    id="one_bills"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.one_bills"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.one_bills" />
            </div>

            <div>
                <InputLabel for="five_bills" value="5 Bills" />

                <TextInput
                    id="five_bills"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.five_bills"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.five_bills" />
            </div>

                        <div>
                <InputLabel for="ten_bills" value="10 Bills" />

                <TextInput
                    id="ten_bills"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.ten_bills"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.ten_bills" />
            </div>

            <div>
                <InputLabel for="fifty_bills" value="50 Bills" />

                <TextInput
                    id="fifty_bills"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.fifty_bills"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.fifty_bills" />
            </div>

            <div>
                <InputLabel for="hundred_bills" value="100 Bills" />

                <TextInput
                    id="hundred_bills"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.hundred_bills"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.hundred_bills" />
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
