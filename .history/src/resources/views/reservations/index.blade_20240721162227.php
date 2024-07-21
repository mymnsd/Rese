@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約一覧</h1>
    <ul>
        @foreach ($reservations as $reservation)
            <li>
                <a href="{{ route('reservations.show', $reservation) }}">
                    {{ $reservation->id }} - {{ $reservation->start_at }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection