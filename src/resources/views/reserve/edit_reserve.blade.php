@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_reserve.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="edit-container">
  <div class="edit-container__inner">
    <div class="edit-container__content">
      <h3 class="edit__ttl">変更する項目を入力してください</h3>
      <form class="edit-form" action="{{ route  ('reserve.update', $reservation->id) }}" method="post">
        @csrf
        @method('put')
        <table class="edit-table">
          <tr class="edit-table__row">
            <th class="edit-table__ttl">Shop</th>
            <td class="edit-table__item--shop">{{ $reservation->shop->name }}</td>
          </tr>
          <tr class="edit-table__row">
            <th class="edit-table__ttl"><label for="new_date">Date</label>
            </th>
            <td class="edit-table__item--date"><input class="edit__form--date" type="date" id="new_date" name="start_at" value="{{ $reservation->start_at->format('Y-m-d') }}"></td>
          </tr>
          <tr class="edit-table__row">
            <th class="edit-table__ttl"><label for="new_time">Time</label>
            </th>
            <td class="edit-table__item--time">
              <select class="edit__form--time" name="time" id="time">
                @for($i = 11; $i <= 23; $i++)
                  @for($j = 0; $j <= 30; $j += 30)
                    @php
                      $time = sprintf('%02d:%02d', $i, $j);
                      $reservationTime = $reservation->start_at->format('H:i');
                    @endphp
                      <option label="{{ $time }}" value="{{ $time }}" @if($reservationTime == $time) selected @endif>
                        {{ $time }}
                      </option>
                  @endfor
                @endfor
              </select>
            </td>
          </tr>
      
          <tr class="edit-table__row">
            <th class="edit-table__ttl">
              <label class="label" for="new_guest_count">Number</label>
            </th>
            <td class="edit-table__item--people">
              <select class="edit__form--people" name="guest_count" id="guest_count">
                @for($i = 1; $i <= 20; $i++)
                  <option value="{{ $i }}" @if($reservation->guest_count == $i) selected @endif>
                  {{ $i }}人
                  </option>
                @endfor
              </select>
            </td>
          </tr>
        </table>
          <div class="btn-area">
            <button class="edit__form-btn" type="submit">変更する</button>
            <a href="/mypage" class="edit__form-link">変更しない</a>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection