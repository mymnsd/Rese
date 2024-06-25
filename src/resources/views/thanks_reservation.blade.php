@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_reservation.css') }}">
@endsection

@section('title')
  <h1 class="header__ttl">Rese</h1>
@endsection

@section('content')
<div class="thanks-page">
  <div class="thanks-page__inner">
    <p class="thanks-page__message">ご予約ありがとうございます</p>
    <form class="thanks-page__form" action="/" method="get">
      <button class="thanks-page__btn btn">戻る</button>
    </form>
  </div>
</div>
@endsection