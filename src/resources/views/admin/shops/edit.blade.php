@extends('layouts.admin')

@section('content')
    <h1>店舗編集</h1>
    <form action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">店舗名:</label>
            <input type="text" name="name" id="name" value="{{ $shop->name }}" required>
        </div>
        <div>
            <label for="area_id">エリア:</label>
            <select name="area_id" id="area_id" required>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="genre_id">ジャンル:</label>
            <select name="genre_id" id="genre_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image">店舗画像:</label>
            <input type="file" name="image" id="image">
            <img src="{{ asset($shop->image_url) }}" alt="店舗画像">
        </div>
        <button type="submit">更新</button>
    </form>
@endsection