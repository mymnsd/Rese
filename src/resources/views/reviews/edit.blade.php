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
  <div class="edit-inner">
    <h2 class="content__ttl">口コミを編集する</h2>

    <form class="form" action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label class="form__label" for="rating">満足度:</label>
      <div id="starRating">
        <span data-value="1" class="star"><i class="fas fa-star"></i></span>
        <span data-value="2" class="star"><i class="fas fa-star"></i></span>
        <span data-value="3" class="star"><i class="fas fa-star"></i></span>
        <span data-value="4" class="star"><i class="fas fa-star"></i></span>
        <span data-value="5" class="star"><i class="fas fa-star"></i></span>
      </div>
    <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}" required>
      @error('rating')
        <div class="text-danger">{{ $message }}</div>
      @enderror

      <div class="form-group">
        <label class="form__label" for="comment">コメント:</label>
        <textarea class="form-control" id="comment" name="comment">{{ old('comment', $review->comment) }}</textarea>
        <div style="text-align: right;">
          <small id="char-count">0/400（最高文字数）</small>
        </div>
        @error('comment')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form__label" for="image">画像:</label>
        <input class="form__input" type="file" name="image" id="image" accept=".jpeg,.png" onchange="validateImage(event)">

        @if ($review->image_path)
          <div class="current-image" id="imageContainer">
            <p>現在の画像:</p>
            <img id="currentImage" src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image" style="max-width: 200px; height: auto;">
            <div class="delete-image-btn">
              <a href="{{ route('reviews.removeImage', $review->id) }}" class="btn">画像を削除</a>
            </div>
          </div>
        @endif

        <div id="newImagePreview" style="margin-top: 10px;">
        </div>

        <div id="imageError" style="color: red; margin-top: 10px;"></div>
      </div>

      <button class="btn" type="submit">更新</button>
    </form>
    <div class="back-link">
      <a class="link" href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}">店舗詳細へ戻る</a>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#starRating .star');
    const ratingInput = document.getElementById('rating');
    const initialRating = parseInt(ratingInput.value);

    if (initialRating) {
        for (let i = 0; i < initialRating; i++) {
            stars[i].classList.add('selected');
        }
    }

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;

            stars.forEach(star => {
                star.classList.remove('selected');
            });
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
  });

  function validateImage(event) {
        var fileInput = event.target;
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
        var errorContainer = document.getElementById('imageError');
        var newImagePreview = document.getElementById('newImagePreview');

        errorContainer.textContent = '';
        newImagePreview.innerHTML = '';

        if (!allowedExtensions.exec(filePath)) {
            errorContainer.textContent = "対応していないファイル形式です。JPEGまたはPNGファイルを選択してください。";
            fileInput.value = ''; 
            return;
        }

        previewImage(event);
    }

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var newImage = document.createElement('img');
            newImage.src = reader.result;
            newImage.alt = 'New Image';
            newImage.style.maxWidth = '200px';
            newImage.style.height = 'auto';

            var output = document.getElementById('newImagePreview');
            output.innerHTML = '<p>新しい画像プレビュー:</p>';
            output.appendChild(newImage);
        };

        reader.readAsDataURL(event.target.files[0]);
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
</script>
@endsection