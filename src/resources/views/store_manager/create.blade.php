@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新しい店舗情報を作成</h2>

    <form action="{{ route('store_manager.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <label for="area_id">エリア</label>
        <input type="number" name="area_id" id="area_id" required>

        <label for="genre_id">ジャンル</label>
        <input type="number" name="genre_id" id="genre_id" required>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
        </div>

        <label for="image_url">画像URL</label>
        <input type="url" name="image_url" id="image_url">

        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection