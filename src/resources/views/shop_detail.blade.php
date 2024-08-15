@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
  <div class="detail__content-inner">
    {{-- 店舗欄 --}}
    <article class="card__group">
      <div class="ttl-group">
        @if(Auth::check())
        <a class="back-link" href="/mypage"></a>
        @else
        <a class="back-link" href="/"></a>
        @endif
        <h2 class="card__ttl">{{ $shop->name }}</h2>
      </div>

      {{-- レビュー、コメント欄 --}}
      <h3>レビュー</h3>
        @if($shop->reviews->isEmpty())
          <p>レビューはまだありません。</p>
        @else
        @foreach($shop->reviews as $review)
          <div>
            <p><strong>{{ $review->user->name }}</strong>さんの満足度（５段階）: {{ $review->rating }}</p>
            <p>{{ $review->comment }}</p>
            <p>投稿日時: {{ $review->created_at->format('Y-m-d H:i') }}</p>
          </div>    
        @endforeach
        @endif
      
      <div class="card__img">
          <img src="{{ $shop->image_url}}" alt="店舗画像">
      </div>
      <div class="card__content">
        <span class="card__tag">#{{ $shop->area->name }}</span>
        <span class="card__tag">#{{ $shop->genre->name }}</span>
      </div>
      <p class="card-desc">{{ $shop->description }}</p>
    </article>
    
    {{-- 予約欄 --}}
    <div class="reservation__group">
      <h3 class="reservation__ttl">予約</h3>
      <form class="reservation__form" action="/reserve" method="post">
        @csrf
        <div class="select-area__group">
          <input type="hidden" name="shop_id" value="{{ $shop->id }}">
          <input class="reservation__form--date" type="date" name="date" id="date" value="{{ request('date') }}">
          @error('date')
            <div class="reservation-error-message">{{ $message }}</div>
          @enderror
        
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
          @error('time')
          <div class="reservation-error-message">{{ $message }}</div>
          @enderror
          <div class="select-area">
            <select class="reservation__form--people" name="guest_count" id="guest_count">
              <option value="" selected="">選択してください</option>
              @for($i = 1; $i <=20; $i++)
                <option value="{{ $i }}" 
                @if(request('guest_count') == $i) selected @endif>
                {{ $i }}人
                </option>
              @endfor
            </select>
          </div>
          @error('guest_count')
            <div class="reservation-error-message">
            {{ $message }}
            </div>
          @enderror
        </div>
        
      <input type="hidden" name="start_at" id="start_at"> 
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