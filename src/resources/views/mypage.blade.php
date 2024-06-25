@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('title')
  <h1 class="header__ttl">Rese</h1>
@endsection

@section('content')
<div class="content__group">
  <h3 class="content__ttl">予約状況</h3>
  <div class="status-area">
    <p class="status-ttl">Shop
          <span class="status__item"></span>
        </p>
        <p class="status-ttl">Date
          <span class="status__item"></span>
        </p>
        <p class="status-ttl">Time
          <span class="status__item"></span>
        </p>
        <p class="status-ttl">Number
          <span class="status__item"></span>
        </p>
  </div>
</div>

<div class="favorite__group">
  <h2 class="user">testさん</h2>
  <h3 class="content__ttl">お気に入り店舗</h3>
  <div class="card__area">
  <article class="card__group">
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
  </article>
</div>
</div>
@endsection