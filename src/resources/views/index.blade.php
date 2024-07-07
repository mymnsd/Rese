@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('nav')
<nav class="header__nav">
  <ul class="header__nav-list">
    <form class="search-form" action="" method="get">
        @csrf
      <li class="header__nav-item">
        <select name="area" id="area">
          <option value="All area" {{ request('area') == 'All area' ? 'selected' : '' }}>All area</option>
          @foreach($areas as $area)
          <option value="{{ $area->name }}" {{ request('area') == $area->name ? 'selected' : '' }}>{{ $area->name }}
          </option>
          @endforeach 
        </select>
      </li>
      <li class="header__nav-item">
        <select name="genre" id="genre">
          <option value="All genre" {{ request('genre') == 'All genre' ? 'selected' : '' }}>All genre</option>
          @foreach($genres as $genre)
          <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>{{  $genre->name }}
          </option>
          @endforeach 
        </select>
      </li>
      <button class="search-btn" type="submit">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
      <li class="header__nav-item">
        <input class="search-form__keyword" type="text" name="keyword" id="keyword" placeholder="Search..." value="{{request('keyword')}}">
      </li>
    </form>
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
        <p class="card__tag">#{{ $shop->area->name }}</p>
        <p class="card__tag">#{{ $shop->genre->name }}</p>
        <div class="card__flex">
          <div class="card-link">
            <a class="card-link--button" href="{{ route('shops.detail', $shop->id) }}">詳しく見る</a>
          </div>
          <form class="favorite-form" action="{{ $shop->isFavorite() ? route('favorite.delete') : route('favorite.create') }}" method="post">
          @csrf
            <input class="favorite-input" type="hidden" name="shop_id" value="{{ $shop->id }}">
            <input type="hidden" name="redirect_url" value="/">
            <label class="heart">
            <input type="checkbox" id="heartCheckbox" name="favorite" value="1" {{ $shop->isFavorite() ? 'checked' : '' }} onchange="this.form.submit()">
            <i class="fa-solid{{ $shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
            </label>
            <button type="submit" style="display: none;"></button>
          </form>
        </div>
      </div>
    </article>
    @endforeach
  </div>
</div>

@endsection