@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/reservations.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="reservation__inner">
    <h2 class="content__ttl">予約一覧</h2>
    <table class="reservation-table">
      <tr class="reservation-table__row">
        <th class="reservation-table__header">予約ID</th>
        <th class="reservation-table__header">予約人数</th>
        <th class="reservation-table__header">予約開始日時</th>
        <th class="reservation-table__header">予約作成日時</th>
      </tr>
      @foreach($reservations as $reservation)
      <tr class="reservation-table__row">
        <td class="reservation-table__item">{{ $reservation->id }}</td>
        <td class="reservation-table__item">{{ $reservation->guest_count }}</td>
        <td class="reservation-table__item">{{ $reservation->start_at }}</td>
        <td class="reservation-table__item">{{ $reservation->created_at }}</td>
      </tr>
      @endforeach
    </table>

    <div class="back-link">
      <a class="link" href="{{ route('store_manager.index') }}">店舗代表者管理ページに戻る</a>
    </div>
  </div>
</div>
@endsection