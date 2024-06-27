@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('title')
  <h1 class="header__ttl">Rese</h1>
@endsection

@section('content')
<div class="detail__content">
  <div class="detail__content-inner">
    <article class="card__group">
      <div class="ttl-group">
        <a class="back-link" href="/"></a>
        <h2 class="card__ttl">{{ $shop->name }}</h2>
      </div>
      <div class="card__img">
          <img src="{{ $shop->image_url}}" alt="店舗画像">
      </div>
      <div class="card__content">
          
        <p class="card__tag">{{ $shop->area->name }}</p>
        <p class="card__tag">{{ $shop->genre->name }}</p>
      </div>
      <p class="card-desc">{{ $shop->description }}</p>
    </article>

    <div class="reservation__group">
      <p class="reservation__ttl">予約</p>
      <form class="reservation__form" action="/reserve" method="post">
        <input class="reservation__form-date" type="date" name="date" value="{{ request('date') }}">
        <select class="reservation__form-time" name="time" id="">
          <option value="" selected="">選択してください</option>
          @for($i = 11; $i <= 23; $i++)
            @for($j = 0; $j <= 30; $j += 30)
            <option label="{{ $i }}:{{ sprintf('%02d',$j) }}" value="{{ $i }}:{{ sprintf('%02d',$j) }}">{{ $i }}:{{ sprintf('%02d',$j) }}</option>
            @endfor
          @endfor
        </select>
        <select class="reservation__form-people" name="guest_count" id="">
          <option value="" selected="">選択してください</option>
          @for($i = 1; $i <=20; $i++)
            <option value="{{ $i }}" @if(request('guest_count') == $i) selected @endif>
              {{ $i }}人
            </option>
          @endfor
        </select>
        <div class="confirm">
          <p class="confirm__ttl">Shop
            <span class="confirm__item">{{ $shop->name }}</span>
          </p>
          <p class="confirm__ttl">Date
            <span class="confirm__item"></span>
          </p>
          <p class="confirm__ttl">Time
            <span class="confirm__item"></span>
          </p>
          <p class="confirm__ttl">Number
            <span class="confirm__item"></span>
          </p>
        </div>
        <button class="reservation__btn" type="submit">予約する</button>
      </form>
    </div>
  </div>  
</div>
@endsection