<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Game;
use App\Models\Judge;
use App\Models\Player;
use App\Services\Contracts\GameServiceInterface;

const ACTIONS = [
  ['class' => Judge::class, 'function' => 'showCard'],
  ['class' => Judge::class, 'function' => 'endMatch'],
  ['class' => Judge::class, 'function' => 'giveFreeKick'],
  ['class' => Player::class, 'function' => 'pass'],
  ['class' => Player::class, 'function' => 'shoot'],
];
class GameService implements GameServiceInterface
{
  public function handle($id)
  {
    $game = Game::findOrFail($id);
    $class = Judge::class;
    $function = 'startMatch';
    $judge = $game->judge;
    $time = 1;
    $judge->$function($game->id, $time);
    while (true) {
      $time++;
      $tmp = ACTIONS[array_rand(ACTIONS)];
      $function = $tmp['function'];
      $class = $tmp['class'];
      $player = Player::whereIn('id', array_merge(
        Club::where('id', $game->home)->first()->players->pluck('id')->all(),
        Club::where('id', $game->away)->first()->players->pluck('id')->all()
      ))->inRandomOrder()->first();
      if ($class == Player::class) {
        $player->$function($game->id, $time);
      } else {
        if ($function == 'showCard') {
          $judge->$function($game->id, $time, $player->id);
        } else {
          $judge->$function($game->id, $time);
        }
      }
      if ($function == 'endMatch') {
        break;
      }
    }
  }
}
