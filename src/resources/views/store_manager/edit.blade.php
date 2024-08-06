@extends('layouts.app')

@section('content')
<div class="container">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <h2>店舗情報の編集</h2>
    <form action="{{ route('store_manager.update', ['shopId' => $shop->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $shop->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $shop->description) }}</textarea>
        </div>

        <div class="form-group">
          <label for="image">画像</label>
          <input type="file" name="image" id="image" class="form-control">
          <img id="imagePreview" src="{{ $shop->image_url }}" alt="店舗画像" style="display: {{ $shop->image_url ? 'block' : 'none' }}; max-width: 100%; height: auto; margin-top: 10px;">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>

    

    <a href="{{ route('store_manager.index') }}" class="btn btn-secondary mt-3">店舗情報ページに戻る</a>

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