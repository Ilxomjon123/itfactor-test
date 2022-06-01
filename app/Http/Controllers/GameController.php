<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Game;
use App\Models\Judge;
use App\Models\Player;
use App\Models\Stadion;
use Illuminate\Http\Request;

const ACTIONS = [
    ['class' => Judge::class, 'function' => 'showCard'],
    ['class' => Judge::class, 'function' => 'endMatch'],
    ['class' => Judge::class, 'function' => 'giveFreeKick'],
    ['class' => Player::class, 'function' => 'pass'],
    ['class' => Player::class, 'function' => 'shoot'],
];
class GameController extends Controller
{
    public function index()
    {
        $games = Game::has('histories')->latest()->paginate(20);
        return view('index', compact('games'));
    }

    public function game()
    {
        $home = Club::inRandomOrder()->first();
        $away = Club::where('id', '!=', $home->id)->inRandomOrder()->first();
        $stadion = Stadion::inRandomOrder()->first();
        $judge = Judge::inRandomOrder()->first();
        $game = Game::create([
            'home' => $home->id,
            'away' => $away->id,
            'stadion_id' => $stadion->id,
            'judge_id' => $judge->id,
        ]);
        return view('game', compact('home', 'away', 'stadion', 'judge', 'game'));
    }

    public function startGame(Request $request, $id)
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
        return redirect()->route('statistics', $game->id);
    }

    public function statistics(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        return view('statistics', compact('game'));
    }
}
