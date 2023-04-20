<template>
    <DefaultLayout title="Create new key">
        <div class="divide-y divide-white/5">
            <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-white">
                        General
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-400">
                        General Settings about the key.
                    </p>
                </div>

                <form
                    class="md:col-span-2"
                    @submit.prevent="submitForm"
                >
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
                        <div class="col-span-full">
                            <label
                                for="key"
                                class="block text-sm font-medium leading-6 text-white"
                            >Key Name</label>
                            <div class="mt-2">
                                <input
                                    id="key"
                                    v-model="form.key"
                                    name="key"
                                    type="text"
                                    autocomplete="key"
                                    class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                >
                                <InputError class="mt-2"
                                    :message="form.errors.key"
                                />
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label
                                for="fallback_value"
                                class="block text-sm font-medium leading-6 text-white"
                            >Fallback Value</label>
                            <div class="mt-2">
                                <input
                                    id="fallback_value"
                                    v-model="form.fallback_value"
                                    name="fallback_value"
                                    type="text"
                                    autocomplete="fallback_value"
                                    class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                >
                                <InputError class="mt-2"
                                    :message="form.errors.fallback_value"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex">
                        <button type="submit"
                            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    key: '',
    fallback_value: '',
});

const submitForm = () => {
    form.post(route('locale-string.store'));
};
</script>
