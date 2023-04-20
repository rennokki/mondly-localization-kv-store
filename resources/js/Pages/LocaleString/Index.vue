<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <a
                :href="route('locale-string.download')"
                class="ml-3 inline-flex items-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
            >
                Download Archive
            </a>
            <Link
                :href="route('locale-string.create')"
                class="ml-3 inline-flex items-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
            >
                New Key
            </Link>
        </template>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0"
                                >
                                    Key
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white"
                                >
                                    Fallback
                                </th>
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white"
                                >
                                    Languages
                                </th>
                                <th scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                >
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            <tr v-for="string in localeStrings"
                                :key="string.key"
                            >
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                    {{ string.key }}
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                    {{ string.fallback_value }}
                                </td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                    {{ string.translations_count }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <Link
                                        :href="route('locale-string.edit', string.key)"
                                        class="text-indigo-400 hover:text-indigo-300"
                                    >
                                        <PrimaryButton>
                                            Edit
                                        </PrimaryButton>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- {{ localeStrings }} -->
    </DefaultLayout>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    localeStrings: {
        default: [],
    },
});
</script>
