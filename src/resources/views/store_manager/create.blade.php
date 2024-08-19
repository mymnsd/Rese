@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/create.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="store-manager__inner">
    <h2 class="content__ttl">新しい店舗情報を作成</h2>

    <form class="form" action="{{ route('store_manager.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="form-group">
        <label class="form-label" for="name">店舗名</label>
        <input class="form-input" type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="area_id">エリア</label>
        <select class="form-select" name="area_id" id="area_id" class="form-control" required>
          <option value="">選択してください</option>
          @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label class="form-label" for="genre_id">ジャンル</label>
        <select class="form-select" name="genre_id" id="genre_id" class="form-control" required>
          <option value="">選択してください</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">説明</label>
        <textarea class="form-control" name="description" id="description">
        </textarea>
      </div>

      <div class="form-group">
        <label class="form-label" for="price">価格</label>
        <input class="form-input" type="text" name="price" id="price" class="form-control" required>円
      </div>

      <div class="form-group">
        <label class="form-label" for="image">画像</label>
        <input  class="form-input" type="file" name="image" id="image" class="form-control">
        <!-- 画像プレビュー -->
          <img clss="img" id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
      </div>

        <button type="submit" class="btn--blue">作成</button>
        
    </form>

    <div class="back-link">
      <a class="link" href="{{ route('store_manager.index') }}" >店舗情報ページに戻る</a>
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
</script>

@endsection