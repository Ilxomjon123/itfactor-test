@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <h1>{{ $game->homeClub->name . ' ' . $game->score_home . ' - ' . $game->score_away . ' ' . $game->awayClub->name }}
  </h1>
  <h3>Match Statistics</h3>
</div>
<div class="container">
  @foreach ($game->histories as $item)
  @if($item->isHomePlayer())
  <p>{{ $item->time . "' " . $item->action . ' - ' . $item->player->personal_info->firstname . ' ' .
    $item->player->personal_info->lastname }}</p>
  @elseif(!empty($item->player_id))
  <p class="text-end">{{$item->player->personal_info->firstname . ' ' .
    $item->player->personal_info->lastname . ' - ' . $item->action . ' ' . $item->time . "'" }}</p>
  @else
  <p class="text-center">{{ $item->time . "' " . $item->action }}</p>
  @endif
  @endforeach
  <div class="text-center">
    <a href="/game" class="btn btn-primary my-2">Change Match</a>
  </div>

</div>
@endsection