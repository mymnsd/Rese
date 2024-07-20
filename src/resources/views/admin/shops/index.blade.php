@extends('layouts.admin')

@section('content')
    <h1>店舗一覧</h1>
    <a href="{{ route('shops.create') }}">新規店舗作成</a>

    @foreach ($shops as $shop)
        <div>
            <h2>{{ $shop->name }}</h2>
            <p>エリア: {{ $shop->area->name }}</p>
            <p>ジャンル: {{ $shop->genre->name }}</p>
            <img src="{{ asset($shop->image_url) }}" alt="店舗画像">
            <a href="{{ route('shops.edit', $shop->id) }}">編集</a>
            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @endforeach
@endsection