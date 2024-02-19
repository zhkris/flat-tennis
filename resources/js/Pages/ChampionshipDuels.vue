<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ChampionshipWithDuels } from "@/types/types";

defineProps<{
    championship: ChampionshipWithDuels;
}>();
</script>

<template>
    <Head title="Duels" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Duels
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1>{{ championship.name }}</h1>
                        <ul class="mt-4">
                            <li
                                v-for="duel in championship.duels"
                                :key="duel.id"
                            >
                                <a
                                    :href="route('duels.show', duel.id)"
                                    class="block p-2 rounded-md hover:bg-gray-100"
                                >
                                    <span
                                        :class="{
                                            'font-bold text-emerald-500':
                                                duel.winner_id ===
                                                duel.player_one_id,
                                        }"
                                        >{{ duel.player_one.name }}</span
                                    >
                                    -
                                    <span
                                        :class="{
                                            'font-bold text-emerald-500':
                                                duel.winner_id ===
                                                duel.player_two_id,
                                        }"
                                        >{{ duel.player_two.name }}</span
                                    >
                                    (<span
                                        :class="{
                                            'font-bold text-emerald-500':
                                                duel.winner_id ===
                                                duel.player_one_id,
                                        }"
                                        >{{ duel.player_one_wins }}</span
                                    >/
                                    <span
                                        :class="{
                                            'font-bold text-emerald-500':
                                                duel.winner_id ===
                                                duel.player_two_id,
                                        }"
                                        >{{ duel.player_two_wins }}</span
                                    >)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
