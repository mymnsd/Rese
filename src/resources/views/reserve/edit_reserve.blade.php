@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_reserve.css') }}">
@endsection

<div class="edit-container">
  <div class="edit-content">
    <p class="edit-message">予約変更</p>
    <form class="edit-form" action="{{ route('reserve.update', $reservation->id) }}" method="post">
    @csrf
    @method('put')
      <label for="new_date">新しい日付:</label>
      <input type="date" id="new_date" name="start_at" value="{{ $reservation->start_at->format('Y-m-d') }}">
    
      <label for="new_time">新しい時間:</label>
      {{-- <input type="time" id="new_time" name="start_at_time" value="{{ $reservation->start_at->format('H:i') }}"> --}}
      <select class="reservation__form-time" name="time" id="time">
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
    
      <label for="new_guest_count">人数:</label>
      {{-- <input type="number" id="new_guest_count" name="guest_count" value="{{ $reservation->guest_count }}"> --}}
      <select class="reservation__form-people" name="guest_count" id="guest_count">
            @for($i = 1; $i <= 20; $i++)
                <option value="{{ $i }}" @if($reservation->guest_count == $i) selected @endif>
                    {{ $i }}人
                </option>
            @endfor
        </select>
      <button class="edit-form-btn" type="submit">はい</button>
    </form>
      <a href="/mypage" class="edit-form-btn">いいえ</a>
  </div>
</div>