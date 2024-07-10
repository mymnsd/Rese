@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm_cancel.css') }}">
@endsection

@section('content')
<div class="cancel-container">
  <div class="cancel-container__inner">
    <div class="cancle-container__content">
      <h3 class="cancel__ttl">予約のキャンセル確認</h3>
      <p class="cancel-message">本当に予約をキャンセルしますか？<br>この操作は取り消せません。</p>
      <table class="confirm-table">
        <tr class="confirm-table__row">
          <th class="confirm-table__ttl">Shop</th>
          <td class="confirm-table__item">{{ $reservation->shop->name }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__ttl">Date</th>
          <td class="confirm-table__item">{{ $reservation->start_at->format('Y-m-d') }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__ttl">Time</th>
          <td class="confirm-table__item">{{ $reservation->start_at->format('H:i') }}</td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__ttl">Number</th>
          <td class="confirm-table__item">{{ $reservation->guest_count }}人</td>
        </tr>
        {{-- <p>Shop: {{ $reservation->shop->name }}</p> --}}
        {{-- <p>Date: {{ $reservation->start_at->format('Y-m-d') }}</p>
        <p>Time: {{ $reservation->start_at->format('H:i') }}</p>
        <p>Number: {{ $reservation->guest_count }}人</p> --}}
      </table>
      <form class="cancel-form" action="{{ route('reserve.confirmCancel', ['id' => $reservation->id]) }}" method="POST">
      @csrf
        <button type="submit" class="cancel-btn-1">OK</button>
        <div class="cancel-btn-2">
          <a href="/mypage" class="cancel-btn-2--link">戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection