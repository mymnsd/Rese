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

    <form class="form" action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label class="form__label" for="rating">満足度:</label>
      <input class="form__input" type="number" name="rating" value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
      <div class="form-group">
        <label class="form__label" for="comment">コメント:</label>
        <textarea class="form-control" name="comment">{{ old('comment', $review->comment) }}</textarea>
      </div>

      <div class="form-group">
        <label class="form__label" for="image">画像:</label>
        <input class="form__input" type="file" name="image" accept=".jpeg,.png">
        
        @if ($review->image_path)
          <div class="current-image">
            <p>現在の画像:</p>
            <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image" style="max-width: 100%; height: auto;">
            <a href="{{ route('reviews.removeImage', $review->id) }}" class="btn btn-link">画像を削除</a>
          </div>
        @endif
      </div>


      <button class="btn" type="submit">更新</button>
    </form>
    <div class="back-link">
      <a class="link" href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}">店舗詳細へ戻る</a>
    </div>
  </div>
</div>
@endsection