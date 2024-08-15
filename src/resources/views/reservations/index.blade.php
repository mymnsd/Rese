@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_review.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="inner">
    <h2 class="content__ttl">レビューを投稿するショップを選択してください</h2>
    @foreach($reservations as $reservation)
      <div class="reservation-list">
        <p class="reservation-item">予約ID: {{ $reservation->id }}</p>
        <p class="reservation-item">店舗名: {{ $reservation->shop->name }}</p>
        <p class="reservation-item">予約日時: {{ $reservation->start_at }}</p>
        @if($reservation->canReview())
        <div class="review-btn">
          <a href="{{ route('reviews.create', $reservation) }}" class="btn">レビューを書く</a>
        </div>
        @else
          <p class="after-review">レビューは来店後に投稿できます。</p>
        @endif
        <hr>
      </div>
      @endforeach
      <div class="link">
        <a class="back-link" href="/mypage">マイページへ戻る</a>
      </div>
  </div>
</div>
@endsection