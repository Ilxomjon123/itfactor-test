@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <h1>{{ $home->name }} - {{ $away->name }}</h1>
  <h4>Stadium: {{ $stadion->name }}</h4>
  <h5>Referee: {{ "{$judge->personal_info->firstname} {$judge->personal_info->lastname}" }}</h5>
  <a href="/game/{{ $game->id }}" class="btn btn-success mt-2">Start Match</a>
  <a href="" class="btn btn-primary mt-2">Change Match</a>
</div>
@endsection