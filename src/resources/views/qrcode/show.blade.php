@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="qrcode__inner">
    <h2 class="content__ttl">予約確認用QRコード</h2>
    <div class="qrcode">
        {!! $qrCode !!}
    </div>
    <p class="qrcode-item">
        予約ID: {{ $reservation->id }}</p>
    <p class="qrcode-item">
        店舗ID: {{ $reservation->shop_id }}</p>
    <p class="qrcode-item">
        店舗名: {{ $reservation->shop->name }}</p>
    <p class="qrcode-item">
        お客様ID: {{ $reservation->user_id }}</p>
    <p class="qrcode-item">
        お名前: {{ $reservation->user->name }}様</p> 
    <p class="qrcode-item">
        予約人数: {{ $reservation->guest_count }}人</p>
    <p class="qrcode-item">
        予約日時: {{ $reservation->start_at }}</p>

    <div class="back-link">
      <a class="link" href="/mypage">マイページに戻る</a>
    </div>
  </div>
</div>
@endsection