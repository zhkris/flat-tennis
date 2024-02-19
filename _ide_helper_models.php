<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Championship
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Duel> $duels
 * @property-read int|null $duels_count
 * @method static \Database\Factories\ChampionshipFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Championship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Championship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Championship query()
 * @method static \Illuminate\Database\Eloquent\Builder|Championship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Championship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Championship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Championship whereUpdatedAt($value)
 */
	class Championship extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Duel
 *
 * @property int $id
 * @property int $championship_id
 * @property int $player_one_id
 * @property int $player_two_id
 * @property int|null $winner_id
 * @property int $player_one_wins
 * @property int $player_two_wins
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Championship $championship
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Game> $games
 * @property-read int|null $games_count
 * @property-read \App\Models\Player $playerOne
 * @property-read \App\Models\Player $playerTwo
 * @property-read \App\Models\Player|null $winner
 * @method static \Database\Factories\DuelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Duel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Duel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Duel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Duel whereChampionshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel wherePlayerOneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel wherePlayerOneWins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel wherePlayerTwoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel wherePlayerTwoWins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Duel whereWinnerId($value)
 */
	class Duel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Game
 *
 * @property int $id
 * @property int $player_one_points
 * @property int $player_two_points
 * @property int $player_one_id
 * @property int $player_two_id
 * @property int|null $winner_id
 * @property int $championship_id
 * @property int $duel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Championship $championship
 * @property-read \App\Models\Duel $duel
 * @property-read \App\Models\Player $playerOne
 * @property-read \App\Models\Player $playerTwo
 * @property-read \App\Models\Player|null $winner
 * @method static \Database\Factories\GameFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereChampionshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereDuelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game wherePlayerOneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game wherePlayerOnePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game wherePlayerTwoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game wherePlayerTwoPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereWinnerId($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Player
 *
 * @property int $id
 * @property string $name
 * @property int $championship_wins
 * @property int $championship_loses
 * @property int $duel_wins
 * @property int $duel_loses
 * @property int $game_wins
 * @property int $game_loses
 * @property int $earned_points
 * @property int $lost_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PlayerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereChampionshipLoses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereChampionshipWins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereDuelLoses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereDuelWins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereEarnedPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereGameLoses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereGameWins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereLostPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 */
	class Player extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

