@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
  <div class="mypage__inner">
      @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
      @endif
    <div class="content__group">
      <h3 class="content__ttl">予約状況</h3>
      @if($reservations->isEmpty())
      <p>現在、予約はありません。</p>
      @else
      @foreach($reservations as $index => $reservation)
      <div class="status-area">
        <p class="reservation-num">予約{{ $index + 1 }}</p>
        <form method="post" action="{{ route('reserve.confirmCancelPage', ['id' => $reservation->id]) }}">
        @csrf
          <button type="submit" class="close-btn" >×</button>
        </form>
        <p class="status-ttl">Shop</p>
        <span class="status__item">{{ $reservation->shop->name }}</span>
          <p class="status-ttl">Date</p>
          <span class="status__item">{{ $reservation->start_at->format('Y-m-d') }}</span></p>
          <p class="status-ttl">Time
          <span class="status__item">{{ $reservation->start_at->format('H:i') }}</span>
          <p class="status-ttl">Number</p>
          <span class="status__item">{{ $reservation->guest_count }}人</span>
          <a class="edit-btn" href="{{ route('reserve.edit_reserve', $reservation->id) }}">予約変更</a>
      </div>
    @endforeach
    @endif
    </div>

    <div class="favorite__group">
      <h2 class="user">{{ Auth::user()->name }}さん</h2>
      <h3 class="content__ttl">お気に入り店舗</h3>
      <div class="card__area">
        @if($favorites->isEmpty())
        <p>お気に入りの店舗はありません。</p>
        @else
        @foreach($favorites as $favorite)
        <article class="card__group">
          <div class="card__img">
            <img src="{{ $favorite->shop->image_url }}" alt="店舗画像">
          </div>
          <div class="card__content">
            <h2 class="card__ttl">{{ $favorite->shop->name }}</h2>
            <p class="card__tag">#{{ $favorite->shop->area->name }}</p>
            <p class="card__tag">#{{ $favorite->shop->genre->name }}</p>
            <div class="card__flex">
              <div class="card-link">
                <a class="card-link--button" href="{{ route('shops.detail', $favorite->shop->id) }}">詳しく見る</a>
              </div>
              <form class="favorite-form" action="{{ route('favorite.delete') }}" method="post">
              @csrf
                <input class="favorite-input" type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                <label class="heart">
                  <input type="checkbox" id="heartCheckbox" name="favorite" value="1" checked onchange="this.form.submit()">
                  <i class="fa-solid {{ $favorite->shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
                </label>
                <button type="submit" style="display: none;"></button>
              </form>
            </div>
          </div>
        </article>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

@endsection