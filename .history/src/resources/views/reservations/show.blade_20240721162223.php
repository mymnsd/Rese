@extends('layouts.app')

@section('content')
<div class="container">
    <h1>予約詳細</h1>
    <p>ID: {{ $reservation->id }}</p>
    <p>開始時間: {{ $reservation->start_at }}</p>
    <a href="{{ route('reviews.create', $reservation) }}">レビューを書く</a>
</div>
@endsection