@extends('layouts.admin')

@section('content')
    <h1>新規店舗作成</h1>
    <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">店舗名:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="area_id">エリア:</label>
            <select name="area_id" id="area_id" required>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="genre_id">ジャンル:</label>
            <select name="genre_id" id="genre_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image">店舗画像:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit">保存</button>
    </form>
@endsection