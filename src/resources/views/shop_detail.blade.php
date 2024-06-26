@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('title')
  <h1 class="header__ttl">Rese</h1>
@endsection

@section('content')
<div class="detail__content">
  <div class="detail__group">
    <div class="detail__link">
      <a class="detail__icon" href="">#</a>
    </div>
    <h2 class="shop__name">仙人</h2>
    <div class="shop__img">
      <img src="" alt="仙人">
    </div>
    <p class="shop__tag">#</p>
    <p class="shop__tag">#</p>
    <p class="shop__desc">#</p>
  </div>

  <div class="reservation__group">
    <p class="reservation__ttl">予約</p>
    <form class="reservation__form" action="/reserve" method="post">
      <input type="text">
      <select name="time" id="">
        <option value=""></option>
      </select>
      <select name="member" id="">
        <option value=""></option>
      </select>
      <div class="confirm">
        <p class="confirm__ttl">Shop
          <span class="confirm__item"></span>
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
@endsection