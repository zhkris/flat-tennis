<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Duel, Player } from "@/types/types";
import { computed } from "vue";
import ActionButton from "@/Components/ActionButton.vue";
import axios from "axios";
import { ref } from "vue";

const GAMES_TO_WIN = 3;

const loading = ref(false);

const updateDuelObject = ref<{
    player_one_point: Boolean;
    player_two_point: Boolean;
    player_one_win_game: Boolean;
    player_two_win_game: Boolean;
    player_one_win_duel: Boolean;
    player_two_win_duel: Boolean;
    rollback_last_point: Boolean;
}>({
    player_one_point: false,
    player_two_point: false,
    player_one_win_game: false,
    player_two_win_game: false,
    player_one_win_duel: false,
    player_two_win_duel: false,
    rollback_last_point: false,
});

const props = defineProps<{
    duel: Duel;
}>();

const _duel = ref<Duel>(props.duel);

const resetUpdateDuelObject = () => {
    updateDuelObject.value = {
        player_one_point: false,
        player_two_point: false,
        player_one_win_game: false,
        player_two_win_game: false,
        player_one_win_duel: false,
        player_two_win_duel: false,
        rollback_last_point: false,
    };
};

const currentGameIndex = computed(() => _duel.value.games.length - 1);

const hasWinner = computed(
    () =>
        _duel.value.player_one_wins >= GAMES_TO_WIN ||
        _duel.value.player_two_wins >= GAMES_TO_WIN
);

const winner = computed<Player | null>(() => {
    return _duel.value.winner;
});

const addPoint = async (player: Player) => {
    loading.value = true;
    resetUpdateDuelObject();

    const g = _duel.value.games[currentGameIndex.value];

    if (g.player_one_id === player.id) {
        updateDuelObject.value.player_one_point = true;
        g.player_one_points++;
    }

    if (g.player_two_id === player.id) {
        g.player_two_points++;
        updateDuelObject.value.player_two_point = true;
    }

    if (g.player_one_points >= 10 && g.player_two_points >= 10) {
        // In penalties
        if (Math.abs(g.player_one_points - g.player_two_points) > 1) {
            if (g.player_one_points > g.player_two_points) {
                // Player one wins the Game
                _duel.value.player_one_wins++;
                _duel.value.player_two_loses++;
                g.player_one_points = 0;
                g.player_two_points = 0;
                updateDuelObject.value.player_one_win_game = true;
            } else {
                // Player two wins the Game
                _duel.value.player_two_wins++;
                _duel.value.player_one_loses++;
                g.player_one_points = 0;
                g.player_two_points = 0;
                updateDuelObject.value.player_two_win_game = true;
            }
        }
    } else if (g.player_one_points >= 11) {
        // Player one wins the Game
        _duel.value.player_one_wins++;
        _duel.value.player_two_loses++;
        g.player_one_points = 0;
        g.player_two_points = 0;
        updateDuelObject.value.player_one_win_game = true;
    } else if (g.player_two_points >= 11) {
        // Player two wins the Game
        _duel.value.player_two_wins++;
        _duel.value.player_one_loses++;
        g.player_one_points = 0;
        g.player_two_points = 0;
        updateDuelObject.value.player_two_win_game = true;
    }

    if (_duel.value.player_one_wins >= GAMES_TO_WIN) {
        // Player one wins the Duel
        _duel.value.winner_id = _duel.value.player_one_id;
        _duel.value.winner = _duel.value.player_one;
        updateDuelObject.value.player_one_win_duel = true;
    }
    if (_duel.value.player_two_wins >= GAMES_TO_WIN) {
        // Player two wins the Duel
        _duel.value.winner_id = _duel.value.player_two_id;
        _duel.value.winner = _duel.value.player_two;
        updateDuelObject.value.player_two_win_duel = true;
    }

    // TODO: Make request
    const { data: duel } = await axios.post(
        route("games.update", g.id),
        updateDuelObject.value,
        {
            withCredentials: true,
        }
    );

    _duel.value = duel;

    setTimeout(() => {
        loading.value = false;
    }, 100);
};

const removePoint = (player: Player) => {
    // TODO:
};
</script>

<template>
    <Head title="Duels" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Duel
            </h2>
        </template>

        <div
            v-if="loading"
            class="fixed inset-0 bg-black/25 grid place-content-center"
        >
            <div class="animate-spin text-6xl text-white">
                <i class="fas fa-spinner"></i>
            </div>
        </div>

        <div class="landscape:py-4 portrait:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div
                    class="absolute inset-0 from-green-100 via-white to-red-100 transition-all duration-300"
                    :class="
                        duel.winner.id === duel.player_one_id
                            ? 'bg-gradient-to-r'
                            : 'bg-gradient-to-l'
                    "
                    v-if="hasWinner"
                ></div> -->
                <div
                    class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300"
                    :class="
                        hasWinner
                            ? _duel.winner_id === _duel.player_one_id
                                ? 'from-green-100 via-white to-red-100 bg-gradient-to-r'
                                : 'from-green-100 via-white to-red-100 bg-gradient-to-l'
                            : 'bg-white'
                    "
                >
                    <div
                        class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center"
                    >
                        <!-- Left Side -->
                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ _duel.player_one.name }}
                            </h1>
                            <span
                                class="text-6xl font-bold"
                                :class="
                                    _duel.winner?.id === _duel.player_one_id
                                        ? 'text-green-500'
                                        : hasWinner
                                        ? 'text-black'
                                        : 'text-red-500'
                                "
                                >{{
                                    _duel.games[currentGameIndex]
                                        .player_one_points
                                }}</span
                            >
                        </div>
                        <!-- Status -->
                        <div class="font-bold text-4xl">
                            {{ _duel.player_one_wins }} /
                            {{ _duel.player_two_wins }}
                        </div>
                        <!-- Right Side -->
                        <div class="text-right">
                            <h1 class="text-2xl font-bold">
                                {{ _duel.player_two.name }}
                            </h1>
                            <span
                                class="text-6xl text-red-500 font-bold"
                                :class="
                                    _duel.winner?.id === _duel.player_two_id
                                        ? 'text-green-500'
                                        : hasWinner
                                        ? 'text-black'
                                        : 'text-red-500'
                                "
                                >{{
                                    _duel.games[currentGameIndex]
                                        .player_two_points
                                }}</span
                            >
                        </div>
                    </div>
                </div>

                <!-- Buttons -->

                <div class="overflow-hidden sm:rounded-lg mt-4">
                    <div
                        class="text-gray-900 dark:text-gray-100 flex"
                        :class="
                            hasWinner ? 'justify-center' : 'justify-between'
                        "
                    >
                        <template v-if="hasWinner">
                            <!--  -->
                            <div class="flex flex-col items-center gap-4">
                                <!-- <div
                                    class="p-8 px-24 bg-green-500 text-white text-4xl font-bold rounded-md"
                                >
                                    <i class="fas fa-check"></i>
                                </div> -->
                                <button class="text-gray-500 underline">
                                    Rollback last point
                                </button>
                            </div>
                        </template>
                        <template v-else>
                            <div class="space-x-4">
                                <ActionButton>
                                    <i class="fas fa-minus"></i>
                                </ActionButton>
                                <ActionButton
                                    @click.prevent="addPoint(_duel.player_one)"
                                >
                                    <i class="fas fa-plus"></i>
                                </ActionButton>
                            </div>
                            <div class="space-x-4">
                                <ActionButton>
                                    <i class="fas fa-minus"></i>
                                </ActionButton>
                                <ActionButton
                                    @click.prevent="addPoint(_duel.player_two)"
                                >
                                    <i class="fas fa-plus"></i>
                                </ActionButton>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Old Games -->

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 my-6"
                    v-if="_duel.games.length > 1"
                >
                    <div
                        class="p-6 text-gray-900 dark:text-gray-100 flex flex-col justify-between items-center gap-4"
                    >
                        <div
                            v-for="game in _duel.games
                                .filter(
                                    (g) =>
                                        g.id !==
                                            _duel.games[currentGameIndex].id ||
                                        g.winner_id !== null
                                )
                                .sort((a, b) => (a.id > b.id ? -1 : 1))"
                            :key="game.id"
                            class="flex justify-between w-full"
                        >
                            <div
                                :class="{
                                    'text-green-600':
                                        game.winner_id === _duel.player_one_id,
                                }"
                            >
                                {{ _duel.player_one.name }} (<strong>{{
                                    game.player_one_points
                                }}</strong
                                >)
                            </div>
                            <div
                                :class="{
                                    'text-green-600':
                                        game.winner_id === _duel.player_two_id,
                                }"
                            >
                                {{ _duel.player_two.name }}
                                (<strong>{{ game.player_two_points }}</strong
                                >)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
