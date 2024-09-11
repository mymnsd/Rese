@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('sort')
<nav class="sort-nav">
  <form class="search-form" action="{{ url('/') }}" method="get">
    @csrf
    <ul class="sort-nav-list">
      <li class="sort-nav-item--sort">
        <select class="search-select--sort" name="sort" id="sort" onchange="this.form.submit()">
          <option value="" selected>並び替え：評価高/低</option>
          <option value="random" {{ request('sort') == 'random' ? 'selected' : '' }}>ランダム</option>
          <option value="star_count_desc" {{ request('sort') == 'star_count_desc' ? 'selected' : '' }}>評価が高い順</option>
          <option value="star_count_asc" {{ request('sort') == 'star_count_asc' ? 'selected' : '' }}>評価が低い順</option>
        </select>
      </li>
    </ul>
  </form>
</nav>
@endsection

@section('nav')
<nav class="header__nav">
  <ul class="header__nav-list">
    <form class="search-form" action="" method="get">
        @csrf
      <li class="header__nav-item--area">
        <select class="search-select--area" name="area" id="area">
          <option value="All area" {{ request('area') == 'All area' ? 'selected' : '' }}>All area</option>
          @foreach($areas as $area)
          <option value="{{ $area->name }}" {{ request('area') == $area->name ? 'selected' : '' }}>{{ $area->name }}
          </option>
          @endforeach 
        </select>
      </li>
      <li class="header__nav-item--genre">
        <select class="search-select--genre" name="genre" id="genre">
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
{{-- モーダル --}}
<div class="modal" id="modal">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal__inner">
    <div class="modal__content">
    {{-- モーダルボタン --}}
      <div class="modal__content-button">
        <a class="modal__content-button--icon"
          href="#">
          <span class="modal__content-link--border"></span>
          <span class="modal__content-link--border"></span>
        </a>
      </div>
      <div class="modal-form__group">
        <p class="modal-form__btn">
          <a href="/">Home</a>
        </p>
        <p class="modal-form__btn">
          <a href="/register">Registration</a>
        </p>
        <p class="modal-form__btn">
          <a href="/login">Login</a>
        </p>  
      </div>
    </div>
  </div>
</div>
{{-- モーダル2 --}}
<div class="modal" id="modal2">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal__inner">
    <div class="modal__content">
      {{-- モーダルボタン --}}
      <div class="modal__content-button">
        <a class="modal__content-button--icon"
          href="#">
          <span class="modal__content-link--border"></span>
          <span class="modal__content-link--border"></span>
        </a>
      </div>
      <div class="modal-form__group">
        <p class="modal-form__btn">
          <a class="modal-form__btn" href="/">Home</a>
        </p>
        <form class="form__logout" action="/logout" method="post">
        @csrf
          <button class="logout__btn" type="submit">Logout</button>
        </form>
        <form class="form__mypage" action="/mypage" method="get">
          @csrf
          <button class="mypage__btn" type="submit">Mypage</button>
        </form>
      </div>
    </div>
  </div>
</div>
@if(session('modal') === 'modal2')
<div class="modal" id="modal2" style="display: none;">
  <a href="#!" class="modal-overlay"></a>
  <div class="modal__inner">
    <div class="modal__content">
      <div class="modal-form__group">
        <a href="/">Home</a>
        <form class="form__logout" action="/logout" method="post">
        @csrf
          <button class="logout__btn" type="submit">Logout</button>
        </form>
        <form class="form__mypage" action="/mypage" method="get">
          @csrf
          <button class="mypage__btn" type="submit">Mypage</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('modal2');
        if (modal) {
          modal.style.display = 'block';
        }
      });
    </script>
@endif
{{-- 店舗詳細パネル --}}
<div class="card__area">
  <div class="card__area-inner">
    @foreach ($shops as $shop)
    <article class="card__group">
      <div class="card__img">
        <img src="{{ $shop->image_url}}" alt="店舗画像">
      </div>
      <div class="card__content">
        <h2 class="card__ttl">{{ $shop->name }}</h2>
        <span class="card__tag">#{{ $shop->area->name }}</span>
        <span class="card__tag">#{{ $shop->genre->name }}</span>
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
            <i class="fa-solid fa-2x{{ $shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
            </label>
            <button type="submit" style="display: none;"></button>
          </form>
        </div>
      </div>
    </article>
    @endforeach
  </div>
</div>

<div class="footer-links">
  <p class="admin-link">
    <a class="link" href="{{ route('admin.create_admin') }}">管理者の方はこちら</a>
  </p>
  <p class="store_manager-link">
    <a class="link" href="{{ route('store_manager.login') }}">店舗代表者の方はこちら</a>
  </p>
</div>

@endsection