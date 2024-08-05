@extends('layouts.app')

@section('content')
<div class="container">
    <h2>店舗情報</h2>
    <p><strong>店舗名:</strong> {{ $shop->name }}</p>
    <p><strong>店舗代表者名:</strong> {{ $shop->manager_name }}</p>
    <p><strong>エリア:</strong> {{ $shop->area_id }}</p>
    <p><strong>ジャンル:</strong> {{ $shop->genre_id }}</p>
    <p><strong>説明:</strong> {{ $shop->description }}</p>
    <img src="{{ $shop->image_url }}" alt="店舗画像" style="max-width: 100%; height: auto;">
</div>

<h2>予約一覧</h2>
<a href="{{ route('store_manager.reservations') }}">予約情報を確認</a>

<div>
    <a href="{{ route('store_manager.create') }}" class="btn btn-success">店舗を追加</a>
</div>
<div>
    <a href="{{ route('store_manager.edit') }}" class="btn btn-success">店舗内容を更新</a>
</div>
@endsection