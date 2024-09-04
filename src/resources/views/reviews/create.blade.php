@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="review__inner">
      <div class="flex">
        <div class="flex--left">
          <h2 class="contnt__ttl">今回のご利用はいかがでしたか？</h2>
          <article class="card__group">
            <div class="card__img">
              <img src="{{ $shop->image_url}}" alt="店舗画像">
            </div>
            <div class="card__content">
              <h2 class="card__ttl">{{ $shop->name }}</h2>
              <span class="card__tag">#{{ $shop->area->name }}</span>
              <span class="card__tag">#{{ $shop->genre->name }}</span>
              <div class="card__flex">
                <div class="card-link">
                  <a class="card-link--button" href="{{ route('shops.detail', $shop->id) }}">詳しく見る</a>
                </div>
                <form class="favorite-form" action="{{ $shop->isFavorite() ? route('favorite.delete') : route('favorite.create') }}" method="post">
                @csrf
                  <input class="favorite-input" type="hidden" name="shop_id" value="{{ $shop->id }}">
                  <input type="hidden" name="redirect_url" value="/">
                  <label class="heart">
                  <input type="checkbox" id="heartCheckbox" name="favorite" value="1" {{ $shop->isFavorite() ? 'checked' : '' }} onchange="this.form.submit()">
                  <i class="fa-solid fa-2x{{ $shop->isFavorite() ? ' fa-solid' : ' fa-regular' }} fa-heart"></i>
                  </label>
                  <button type="submit" style="display: none;"></button>
                </form>
              </div>
            </div>
          </article>
        </div>

        <div class="flex--right">
          <form class="form" action="{{ route('reviews.store', $reservation) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <div class="rating-container">
              <label class="form-label" for="rating"> 体験を評価してください</label>
                <div class="rating-stars">
                  <input type="radio" id="star5" name="rating" value="5">
                  <label for="star5" class="star"><i class="fas fa-star"></i></label>
                  <input type="radio" id="star4" name="rating" value="4">
                  <label for="star4" class="star"><i class="fas fa-star"></i></label>
                  <input type="radio" id="star3" name="rating" value="3">
                  <label for="star3" class="star"><i class="fas fa-star"></i></label>
                  <input type="radio" id="star2" name="rating" value="2">
                  <label for="star2" class="star"><i class="fas fa-star"></i></label>
                  <input type="radio" id="star1" name="rating" value="1">
                  <label for="star1" class="star"><i class="fas fa-star"></i></label>
                </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="comment">口コミを投稿</label>
              <textarea id="comment" name="comment" class="form-control text" rows="4" maxlength="400" placeholder="カジュアルな夜のお出かけにおすすめのスポット" required>{{ old('comment') }}</textarea>
              <div style="text-align: right;">
                <small id="char-count">0/400（最高文字数）</small>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="image">画像の追加</label>
                <div id="drop-area" class="drop-area" style="position: relative;">
                  <p>クリックして画像を追加</p>
                  <small>またはドラッグアンドドロップ</small>
                  <input type="file" id="image" name="image" class="form-control img" accept=".jpeg, .png" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                  <div id="preview"></div>
                </div>
                  @error('image')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
            </div>
        </div>
      </div>
        <button type="submit" class="btn-white">口コミを投稿</button>
        </form>
  </div>
</div>

<script>
$(document).ready(function() {
    var dropArea = $('#drop-area');
    var fileInput = $('#image');
    var preview = $('#preview');

    dropArea.on('click', function() {
        fileInput.click();
    });

    dropArea.on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropArea.addClass('dragover');
    });

    dropArea.on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropArea.removeClass('dragover');
    });

    dropArea.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropArea.removeClass('dragover');

        var files = e.originalEvent.dataTransfer.files;
        fileInput[0].files = files; 

        showPreview(files[0]);
    });

    fileInput.on('change', function() {
        var file = fileInput[0].files[0];
        showPreview(file);
    });

    function showPreview(file) {
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 100%; height: auto;"/>');
            };
            reader.readAsDataURL(file);
        } else {
            preview.html('');
        }
    }

    $(document).ready(function() {
      var maxLength = 400;
      var textArea = $('#comment');
      var charCount = $('#char-count');

    charCount.text(`${textArea.val().length}/${maxLength}（最高文字数）`);

      textArea.on('input', function() {
        var currentLength = $(this).val().length;
        charCount.text(`${currentLength}/${maxLength}`);
      });
    });
});
</script>
@endsection

