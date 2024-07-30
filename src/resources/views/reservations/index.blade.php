@extends('layouts.app')

@section('content')
<div class="container">
    <h2>レビューを投稿するショップを選択してください</h2>
    @foreach($reservations as $reservation)
        <div>
            <p>予約ID: {{ $reservation->id }}</p>
            <p>店舗名: {{ $reservation->shop->name }}</p>
            <p>予約日時: {{ $reservation->start_at }}</p>
            @if($reservation->canReview())
                <a href="{{ route('reviews.create', $reservation) }}" class="btn btn-success">レビューを書く</a>
            @else
                <p>レビューは来店後に投稿できます。</p>
            @endif
        </div>
        <hr>
    @endforeach
</div>
@endsection