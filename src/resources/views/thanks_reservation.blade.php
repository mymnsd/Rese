@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_reservation.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="thanks-page">
  <div class="thanks-page__inner">
    <p class="thanks-page__message">ご予約ありがとうございます</p>
      <a class="thanks-page__link" href="/">戻る</a>
  </div>
</div>
@endsection