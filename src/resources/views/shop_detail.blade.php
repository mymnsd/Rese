@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
  <div class="detail__content-inner">
    <article class="card__group">
      <div class="ttl-group">
        @if(Auth::check())
        <a class="back-link" href="/mypage"></a>
        @else
        <a class="back-link" href="/"></a>
        @endif
        <h2 class="card__ttl">{{ $shop->name }}</h2>
      </div>
      <div class="card__img">
          <img src="{{ $shop->image_url}}" alt="店舗画像">
      </div>
      <div class="card__content">
          
        <span class="card__tag">#{{ $shop->area->name }}</span>
        <span class="card__tag">#{{ $shop->genre->name }}</span>
      </div>
      <p class="card-desc">{{ $shop->description }}</p>
    </article>

    <div class="reservation__group">
      <h3 class="reservation__ttl">予約</h3>
      <form class="reservation__form" action="/reserve" method="post">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <input class="reservation__form--date" type="date" name="date" id="date" value="{{ request('date') }}">
        <div class="select-area">
          <select class="reservation__form--time" name="time" id="time">
            <option value="" selected="">選択してください</option>
            @for($i = 11; $i <= 23; $i++)
              @for($j = 0; $j <= 30; $j += 30)
              <option label="{{ $i }}:{{ sprintf('%02d',$j) }}" value="{{ $i }}:{{ sprintf('%02d',$j) }}">{{ $i }}:{{ sprintf('%02d',$j) }}</option>
              @endfor
            @endfor
          </select>
        </div>
        <div class="select-area">
          <select class="reservation__form--people" name="guest_count" id="guest_count">
            <option value="" selected="">選択してください</option>
            @for($i = 1; $i <=20; $i++)
              <option value="{{ $i }}" @if(request('guest_count') == $i) selected @endif>
              {{ $i }}人
              </option>
            @endfor
          </select>
        </div>
        
      <input type="hidden" name="start_at" id="start_at"> 
      {{-- <table class="reservation-table">
        <tr class="reservation-table__row">
          <th class="reservation-table__ttl">Shop</th>
          <td class="reservation-table__item">{{ $shop->name }}</td>
        </tr>
        <tr class="reservation-table__row">
          <th class="reservation-table__ttl">Date</th>
          <td class="reservation-table__item">{{ $reservation->start_at->format('Y-m-d') }}</td>
        </tr>
        <tr class="reservation-table__row">
          <th class="reservation-table__ttl">Time</th>
          <td class="reservation-table__item">{{ $reservation->start_at->format('H:i') }}</td>
        </tr>
        <tr class="reservation-table__row">
          <th class="reservation-table__ttl">Number</th>
          <td class="reservation-table__item">{{ $reservation->guest_count }}人</td>
        </tr> --}}
        
      </table>
        <table class="reservation-table">
          <tr class="reservation-table__row">
            <th class="reservation-table__ttl">Shop</th>
            <td class="reservation-table__item">{{ $shop->name }}</td>
          </tr>
          <tr class="reservation-table__row">
            <th class="reservation-table__ttl">Date</th>
            <td id="reservation_date" class="reservation-table__item"></td>
          </tr>
          <tr class="reservation-table__row">
            <th class="reservation-table__ttl">Time</th>
            <td id="reservation_time" class="reservation-table__item"></td>
          </tr>
          <tr class="reservation-table__row">
            <th class="reservation-table__ttl">Number</th>
            <td id="reservation_guest_count" class="reservation-table__item"></td>
          </tr>
          {{-- <div class="show-reservation">
            
            <p class="show__ttl">Shop </p>
              <span class="show__item">{{ $shop->name }}</span>
            <p class="show__ttl">Date</p>
              <span id="show_date" class="show__item"></span>
            
            <p class="show__ttl">Time</p>
              <span id="show_time" class="show__item"></span>
            
            <p class="show__ttl">Number</p>
              <span id="show_guest_count" class="show__item"></span>
            
          </div> --}}
        </table>
        <button class="reservation__btn" type="submit">予約する</button>
      </form>
    </div>
  </div>  
</div>
<script>
    document.getElementById('date').addEventListener('input', function() {
        document.getElementById('reservation_date').textContent = this.value;
    });

    document.getElementById('time').addEventListener('change', function() {
        document.getElementById('reservation_time').textContent = this.value;
    });

    document.getElementById('guest_count').addEventListener('change', function() {
        document.getElementById('reservation_guest_count').textContent = this.options[this.selectedIndex].text;
    });
</script>
@endsection