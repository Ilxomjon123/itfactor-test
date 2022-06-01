<?php

namespace App\Models;

use App\Traits\CommonUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory, CommonUser;

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function pass($game, $time)
    {
        GameHistory::create([
            'game_id' => $game,
            'player_id' => $this->id,
            'action' => 'Pass',
            'time' => $time
        ]);
    }

    public function shoot($game, $time)
    {
        $shoot = random_int(0, 1);
        GameHistory::create([
            'game_id' => $game,
            'player_id' => $this->id,
            'action' => $shoot ? 'Goal' : 'Shoot',
            'time' => $time
        ]);
        if ($shoot) {
            if (Game::where([
                'home' => $this->club_id,
                'id' => $game
            ])->exists()) {
                $score = 'score_home';
            } else {
                $score = 'score_away';
            }
            $model = Game::find($game);
            $model->$score = $model->$score + 1;
            $model->save();
        }
    }
}
