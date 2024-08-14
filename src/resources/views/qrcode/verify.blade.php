@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="verification__inner">
        <h2 class="content__ttl">QRコード照合</h2>
        <form class="form" id="verificationForm">
            <input class="form-input" type="text" id="reservationId" name="reservation_id" placeholder="予約IDを入力してください">
            <button class="btn" type="button" onclick="verifyQRCode()">確認</button>
        </form>
        <div id="verificationResult" class="verification-result"></div>
        <div class="back-link">
          <a class="link" href="{{ route('store_manager.index') }}">店舗代表者管理ページに戻る</a>
        </div>
    </div>
</div>

<script>
    async function verifyQRCode() {
        const reservationId = document.getElementById('reservationId').value;
        const response = await fetch(`/reservations/${reservationId}/verify`);
        const result = await response.json();

        const resultDiv = document.getElementById('verificationResult');
        if (result.status === 'success') {
          let formattedDate = result.reservation.start_at.replace('T', ' ').replace('.000000Z', '');
            resultDiv.innerHTML = `
                <p>予約が確認されました。</p>
                <p>予約ID: ${result.reservation.id}</p>
                <p>店舗名: ${result.reservation.shop_name}</p>
                <p>お客様名: ${result.reservation.user_name}様</p>
                <p>予約人数: ${result.reservation.guest_count}</p>
                <p>予約日時: ${formattedDate}</p>
            `;
        } else {
            resultDiv.innerHTML = `<p>予約の確認に失敗しました。</p>`;
        }
    }
</script>


{{-- <div class="container">
  <div class="qrcode__inner">
    <h2 class="content__ttl">予約の確認</h2>
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
    </div>
</div> --}}
@endsection