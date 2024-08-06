@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新しい店舗情報を作成</h2>

    <form action="{{ route('store_manager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="area_id">エリア</label>
            <select name="area_id" id="area_id" class="form-control" required>
                <option value="">選択してください</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="genre_id">ジャンル</label>
            <select name="genre_id" id="genre_id" class="form-control" required>
                <option value="">選択してください</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
        </div>

    <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" id="image" class="form-control">
            <!-- 画像プレビュー -->
            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;">
        </div>

        <button type="submit" class="btn btn-primary">作成</button>
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
</script>

@endsection