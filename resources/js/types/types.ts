export type Player = {
    id: number;
    name: string;
};

export type Game = {
    id: number;
    player_one_id: number;
    player_two_id: number;
    player_one: Player;
    player_two: Player;
    player_one_points: number;
    player_two_points: number;
    championship_id: number;
    championship: Championship;
    winner_id: number | null;
    winner: Player | null;
};

export type Duel = {
    id: number;
    player_one_id: number;
    player_one: Player;
    player_one_wins: number;
    player_one_loses: number;
    player_two_id: number;
    player_two: Player;
    player_two_wins: number;
    player_two_loses: number;
    winner_id: number | null;
    winner: Player | null;
    championship_id: number;
    championship: Championship;
    games: Game[];
};

export type Championship = {
    id: number;
    name: string;
};
export type ChampionshipWithDuels = {
    id: number;
    name: string;
    duels: Duel[];
};
