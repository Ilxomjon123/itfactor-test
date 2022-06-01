<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Game;
use App\Models\Judge;
use App\Models\Player;
use App\Models\Stadion;
use App\Services\Contracts\GameServiceInterface;
use Illuminate\Http\Request;


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

    public function startGame(Request $request, $id, GameServiceInterface $gameService)
    {
        $gameService->handle($id);
        return redirect()->route('statistics', $id);
    }

    public function statistics(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        return view('statistics', compact('game'));
    }
}
