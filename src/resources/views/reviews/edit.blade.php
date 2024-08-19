@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')
<div class="container">
  @if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
  @endif
  <div class="inner">
    <h2 class="content__ttl">レビューを編集する</h2>

    <form class="form" action="{{ route('reviews.update', $review->id) }}" method="POST">
      @csrf
      @method('PUT')

      <label class="form__label" for="rating">満足度:</label>
      <input class="form__input" type="number" name="rating" value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
      <div class="form-group">
        <label class="form__label" for="comment">コメント:</label>
        <textarea class="form-control" name="comment">{{ old('comment', $review->comment) }}</textarea>
      </div>

      <button class="btn" type="submit">更新</button>
    </form>
    <div class="back-link">
      <a class="link" href="{{ route('reservations.index') }}">ショップ選択ページへ戻る</a>
    </div>
  </div>
</div>
@endsection