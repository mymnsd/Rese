@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('title')
  <div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="mypage">
  <div class="mypage__inner">
    <div class="content__group">
      <h3 class="content__ttl">予約状況</h3>
      @foreach($reservations as $index => $reservation)
      <div class="status-area">
        <p class="reservation-num">予約{{ $index + 1 }}</p>
        <a href="#" class="close-btn">×</a>
        <p class="status-ttl">Shop</p>
        <span class="status__item">{{ $reservation->shop->name }}</span>
          <p class="status-ttl">Date</p>
          <span class="status__item">{{ $reservation->start_at->format('Y-m-d') }}</span></p>
          <p class="status-ttl">Time
          <span class="status__item">{{ $reservation->start_at->format('H:i') }}</span>
          <p class="status-ttl">Number</p>
          <span class="status__item">{{ $reservation->guest_count }}人</span>   
      </div>
      @endforeach
    </div>

    <div class="favorite__group">
      <h2 class="user">{{ Auth::user()->name }}さん</h2>
      <h3 class="content__ttl">お気に入り店舗</h3>
      <div class="card__area">
        @foreach($favorites as $favorite)
        <article class="card__group">
          <div class="card__img">
            <img src="{{ $favorite->shop->image_url }}" alt="店舗画像">
          </div>
          <div class="card__content">
            <h2 class="card__ttl">{{ $favorite->shop->name }}</h2>
            <p class="card__tag">{{ $favorite->shop->area->name }}</p>
            <p class="card__tag">{{ $favorite->shop->genre->name }}</p>
            <div class="card__flex">
              <div class="card-link">
                <a class="card-link--button" href="{{ route('shops.detail', $favorite->shop->id) }}">詳しく見る</a>
              </div>
              <form class="favorite-form" action="/delete" method="post">
              @csrf
                <input class="favorite-input" type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                <label class="heart">
                  <input type="checkbox" id="heartCheckbox" name="favorite" value="1" {{ $shop->isFavorite() ? 'checked' : '' }} onchange="this.form.submit()">
            <i class="fa-solid{{ $shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
                  {{-- <input type="checkbox" id="heartCheckbox" name="favorite" value="1"  onchange="this.form.submit()">
                  <i class="fa-solid fa-heart"></i> --}}
                </label>
              </form>
            </div>
          </div>
        </article>
        @endforeach
        {{-- <article class="card__group">
          <div class="card__img">
            <img src="" alt="">
          </div>
            <div class="card__content">
              <h2 class="card__ttl">店の名前</h2>
              <p class="card__tag">#</p>
              <p class="card__tag">#</p>
              <div class="card__flex">
                <div class="card__desc">詳しく見る</div>
                <div class="heart"></div>
              </div>
            </div>
        </article> --}}
      </div>
    </div>
  </div>
</div>
@endsection