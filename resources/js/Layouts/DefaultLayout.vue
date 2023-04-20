<template>
    <div class="min-h-full">
        <div class="py-10 space-y-2">
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="min-w-0 flex-1">
                            <h2 class="text-2xl font-bold leading-7 text-white sm:truncate sm:text-3xl sm:tracking-tight">
                                {{ title }}
                            </h2>
                        </div>
                        <div class="mt-4 flex md:ml-4 md:mt-0">
                            <slot name="header" />
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: {
        type: String,
    },
});
</script>
