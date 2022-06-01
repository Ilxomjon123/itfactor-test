<?php

namespace App\Models;

use App\Traits\CommonUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

const CARDS = ['red', 'yellow'];
class Judge extends Model
{
    use HasFactory, CommonUser;

    public function showCard($game, $time, $player)
    {
        $card = CARDS[array_rand(CARDS)];
        if (Game::where([
            'home' => Player::find($player)->club_id,
            'id' => $game
        ])->exists()) {
            $tmp = 'home';
        } else {
            $tmp = 'away';
        }
        $field = $card . '_card_' . $tmp;
        $model = Game::find($game);
        $model->$field = $model->$field + 1;
        $model->save();

        GameHistory::create([
            'game_id' => $game,
            'action' => $card . ' card',
            'player_id' => $player,
            'time' => $time
        ]);
    }

    public function startMatch($game, $time)
    {
        GameHistory::create([
            'game_id' => $game,
            'action' => 'Match Started',
            'time' => $time
        ]);
    }

    public function endMatch($game, $time)
    {
        GameHistory::create([
            'game_id' => $game,
            'action' => 'Match Ended',
            'time' => $time
        ]);
    }

    public function giveFreeKick($game, $time)
    {
        GameHistory::create([
            'game_id' => $game,
            'action' => 'Gave a free kick',
            'time' => $time
        ]);
    }
}
