@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/edit_store_manager.css') }}">
@endsection

@section('content')
{{-- <div class="container">
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
  <div class="edit__inner">
  {{-- @if ($errors->any())
    <div class="error">
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif --}}
    <h2 class="content__ttl">店舗情報の編集</h2>
    <form class="form" action="{{ route('store_manager.update', ['shopId' => $shop->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="form-group">
        <label class="form__label" for="name">店舗名</label>
        <input class="form__input" type="text" name="name" id="name" class="form-control" value="{{ old('name', $shop->name) }}" required>
      </div>

      <div class="form-group">
        <label class="form__label" for="price">価格</label>
        <input class="form__input" type="number" name="price" id="price" value="{{ old('price', $shop->price) }}" required>円
      </div>

      <div class="form-group">
        <label class="form__label" for="description">説明</label>
        <textarea class="form-control" name="description" id="description">{{ old('description', $shop->description) }}</textarea>
      </div>


      <div class="form-group">
        <label class="form__label" for="image">画像</label>
        <input class="form__input" type="file" name="image" id="image" class="form-control">
      </div>
      <div class="edit-img">
      <img class="img" id="imagePreview" src="{{ $shop->image_url }}" alt="店舗画像" style="display: {{ $shop->image_url ? 'block' : 'none' }}">
      </div>

      <button class="btn" type="submit">更新する</button>
    </form>

    <div class="back-link">
      <a class="link" href="{{ route('store_manager.index') }}" class="btn btn-secondary mt-3">店舗情報ページに戻る</a>
    </div>
  </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    // 初期表示時のプレビュー
    document.addEventListener('DOMContentLoaded', function() {
        var imagePreview = document.getElementById('imagePreview');
        var imageInput = document.getElementById('image');

        if (imagePreview.src) {
            imagePreview.style.display = 'block';
        }

        imageInput.addEventListener('change', function() {
            if (imageInput.files.length === 0) {
                imagePreview.style.display = 'none';
            }
        });
    });
</script>

@endsection