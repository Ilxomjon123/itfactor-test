@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <a href="/game" class="btn btn-primary">Click To Start a New Match</a>
  @if (!empty($games->all()))

  <h2 class="mt-5">Matches History</h2>
  @foreach ($games as $item)
  <p>
    <a href="/statistics/{{ $item->id }}" class="text-muted h4">
      {{ $item->homeClub->name . ' ' . $item->score_home . ' - ' . $item->score_away . ' ' . $item->awayClub->name }}
    </a>
  </p>

  @endforeach
  {!! $games->links() !!}
</div>
@endif
@endsection