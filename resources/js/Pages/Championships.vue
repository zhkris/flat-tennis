<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Championship } from "@/types/types";
import { Head } from "@inertiajs/vue3";

defineProps<{
    championships: Championship[];
}>();
</script>

<template>
    <Head title="Championships" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Championships
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1>Championships</h1>

                        <ul class="mt-4">
                            <li v-for="championship in championships">
                                <a
                                    :href="
                                        route(
                                            'championships.show',
                                            championship.id
                                        )
                                    "
                                    class="block p-2 rounded-md hover:bg-gray-100 hover:text-red-500"
                                >
                                    {{ championship.name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
