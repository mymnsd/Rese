@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title')
  <h1 class="site__ttl">
    Rese
  </h1>
@endsection

@section('nav')
<nav class="header__nav">
  <ul class="header__nav-list">
    <li class="header__nav-item">All area</li>
    <li class="header__nav-item">All genre</li>
    <li class="header__nav-item">Search...</li>
  </ul>
</nav>
@endsection

@section('content')
<div class="card__area">
  <div class="card__area-inner">
    @foreach ($shops as $shop)
    <article class="card__group">
      <div class="card__img">
        <img src="{{ $shop->image_url}}" alt="店舗画像">
      </div>
      <div class="card__content">
        <h2 class="card__ttl">{{ $shop->name }}</h2>
        <p class="card__tag">{{ $shop->area->name }}</p>
        <p class="card__tag">{{ $shop->genre->name }}</p>
        <div class="card__flex">
          <div class="card-link">
            <a class="card-link--button" href="{{ route('shops.detail', $shop->id) }}">詳しく見る</a>
          </div>
          <div class="heart"></div>
        </div>
      </div>
    </article>
    @endforeach
  </div>
</div>


@endsection