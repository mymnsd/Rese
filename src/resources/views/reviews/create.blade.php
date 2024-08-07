@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="inner">
    <h2 class="content-ttl">「{{ $reservation->shop->name }}」のレビュー</h2>
    <form action="{{ route('reviews.store', $reservation) }}" method="POST">
    @csrf
        
      <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
      <div class="form-group">
        <label for="rating">満足度 (5段階):</label>
        <select class="rating" name="rating" id="rating" class="form-control">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>

      <div class="form-group">
        <label for="comment">コメント:</label>
        <textarea name="comment" id="comment" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn">送信</button>
    </form>
    <div class="back-link">
      <a class="link" href="{{ route('reservations.index') }}">ショップ選択ページへ戻る</a>
    </div>
  </div>
</div>
@endsection