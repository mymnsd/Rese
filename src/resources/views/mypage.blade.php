@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('title')
  <div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="mypage">
  <div class="mypage__inner">
      @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
      @endif
    <div class="content__group">
      <h3 class="content__ttl">予約状況</h3>
      @if($reservations->isEmpty())
      <p>現在、予約はありません。</p>
      @else
      @foreach($reservations as $index => $reservation)
      <div class="status-area">
        <p class="reservation-num">予約{{ $index + 1 }}</p>
        <form method="post" action="{{ route('reserve.confirmCancelPage', ['id' => $reservation->id]) }}">
        @csrf
          <button type="submit" class="close-btn" >×</button>
        </form>
        <p class="status-ttl">Shop</p>
        <span class="status__item">{{ $reservation->shop->name }}</span>
          <p class="status-ttl">Date</p>
          <span class="status__item">{{ $reservation->start_at->format('Y-m-d') }}</span></p>
          <p class="status-ttl">Time
          <span class="status__item">{{ $reservation->start_at->format('H:i') }}</span>
          <p class="status-ttl">Number</p>
          <span class="status__item">{{ $reservation->guest_count }}人</span>
          <button class="edit-link" href="/reserve_edit">予約変更</button>
      </div>
      
      <!-- モーダル -->
{{-- <div id="cancel-modal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <p>本当にキャンセルしますか？</p>
        <form method="post" action="{{ route('reserve.delete', $reservation->id) }}">
            @csrf
            <button type="submit" class="btn-cancel">はい、キャンセルする</button>
        </form>
    </div>
</div> --}}
      <!-- キャンセル確認フォーム -->
{{-- <div class="cancel-form" id="cancelForm{{$reservation->id}}">
    <form method="get" action="{{ route('reserve.delete', $reservation->id) }}">
        @csrf
        <div class="cancel-modal">
            <h5>予約をキャンセルしますか？</h5>
            <p>本当に予約をキャンセルしますか？</p>
            <div class="buttons">
                <button type="submit" class="btn btn-danger">キャンセルする</button>
                <button type="button" class="btn btn-secondary" onclick="hideCancelForm({{$reservation->id}})">キャンセルしない</button>
            </div>
        </div>
    </form>
</div> --}}


      <!-- デバッグ用 -->
{{-- <p>セッション値: showCancelModal = {{ session('showCancelModal') }}, reservationId = {{ session('reservationId') }}</p> --}}
      <!-- モーダルのHTML -->
      {{-- @if (session('showCancelModal') && session('reservationId') == $reservation->id)
        <div id="cancelModal" class="modal" style="display:block;">
          <div class="modal-content">
            <span class="close" onclick="document.getElementById('cancelModal').style.display='none'">&times;</span>
            <h2>予約をキャンセルしますか？</h2>
            <<p>予約{{ $reservation->id }}: {{ $reservation->shop->name }} - {{ $reservation->start_at->format('Y-m-d H:i') }}</p>
            <form method="POST" action="{{ route('reserve.delete', $reservation->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">キャンセルを確定する</button>
            </form>
            <a href="{{ route('reserve.index') }}">戻る</a>
          </div>
        </div>
      @endif --}}
    @endforeach
    @endif

      {{-- 変更確認モーダル --}}
      {{-- <div id="editModal" class="modal4">
        <div class="modal-content">
          <p class="edit-message">予約変更</p>
          <form class="edit-form" action="" method="post">
            @csrf
            @method('put')
            <label for="new_date">新しい日付:</label>
            <input type="date" id="new_date" name="start_at" value="{{ $reservation->start_at->format('Y-m-d') }}">
    
            <label for="new_time">新しい時間:</label>
            <input type="time" id="new_time" name="start_at_time" value="{{ $reservation->start_at->format('H:i') }}">
    
            <label for="new_guest_count">人数:</label>
            <input type="number" id="new_guest_count" name="guest_count" value="{{ $reservation->guest_count }}">
            <button class="edit-form-btn" type="submit">はい</button>
            <button class="edit-form-btn" onclick="claseModal('editModal')">いいえ</button>
          </form>
        </div>
      </div> --}}
    </div>

    <div class="favorite__group">
      <h2 class="user">{{ Auth::user()->name }}さん</h2>
      <h3 class="content__ttl">お気に入り店舗</h3>
      <div class="card__area">
        @if($favorites->isEmpty())
        <p>お気に入りの店舗はありません。</p>
        @else
        @foreach($favorites as $favorite)
        <article class="card__group">
          <div class="card__img">
            <img src="{{ $favorite->shop->image_url }}" alt="店舗画像">
          </div>
          <div class="card__content">
            <h2 class="card__ttl">{{ $favorite->shop->name }}</h2>
            <p class="card__tag">#{{ $favorite->shop->area->name }}</p>
            <p class="card__tag">#{{ $favorite->shop->genre->name }}</p>
            <div class="card__flex">
              <div class="card-link">
                <a class="card-link--button" href="{{ route('shops.detail', $favorite->shop->id) }}">詳しく見る</a>
              </div>
              <form class="favorite-form" action="{{ route('favorite.delete') }}" method="post">
              @csrf
                <input class="favorite-input" type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                <label class="heart">
                  <input type="checkbox" id="heartCheckbox" name="favorite" value="1" checked onchange="this.form.submit()">
                  <i class="fa-solid {{ $favorite->shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
                </label>
                <button type="submit" style="display: none;"></button>
              </form>
            </div>
          </div>
        </article>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
{{-- <script>
function openModal(modalId, action) {
    document.getElementById(modalId).style.display = 'block';
    document.getElementById(modalId).querySelector('form').action = action;
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}
</script> --}}
{{-- <script>
    function showCancelForm(id) {
        var cancelForm = document.getElementById('cancelForm' + id);
        cancelForm.style.display = 'flex'; // フォームを表示する（flex は必要に応じて他のディスプレイ設定に置き換えることができる）
    }

    function hideCancelForm(id) {
        var cancelForm = document.getElementById('cancelForm' + id);
        cancelForm.style.display = 'none'; // フォームを隠す
    }
</script> --}}
@endsection