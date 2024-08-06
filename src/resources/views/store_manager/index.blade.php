@extends('layouts.app')

@section('content')
<div class="container">
    <h2>店舗情報</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @foreach ($managedShops as $shop)
        <div class="shop">
            <p><strong>店舗代表者名:</strong> {{ $shop->manager_name }}</p>
            <p><strong>店舗名:</strong> {{ $shop->name }}</p>
            <p><strong>エリア:</strong> {{ $shop->area->name }}</p>
            <p><strong>ジャンル:</strong> {{ $shop->genre->name }}</p>
            <p><strong>説明:</strong> {{ $shop->description }}</p>
            <img src="{{ $shop->image_url }}" alt="店舗画像" style="max-width: 100%; height: auto;">
            <div>
                <a href="{{ route('store_manager.edit', ['shopId' => $shop->id]) }}" class="btn btn-success">店舗内容を更新</a>
            </div>

            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>

        </div>
    @endforeach

    @foreach ($addedShops as $shop)
        <div class="shop">
            <p><strong>店舗名:</strong> {{ $shop->name }}</p>
            <p><strong>エリア:</strong> {{ $shop->area->name }}</p>
            <p><strong>ジャンル:</strong> {{ $shop->genre->name }}</p>
            <p><strong>説明:</strong> {{ $shop->description }}</p>
            <img src="{{ $shop->image_url }}" alt="店舗画像" style="max-width: 100%; height: auto;">
            <div>
                <a href="{{ route('store_manager.edit', ['shopId' => $shop->id]) }}" class="btn btn-success">店舗内容を更新</a>
            </div>

            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
        </div>
    @endforeach

    <h2>予約一覧</h2>
    <a href="{{ route('store_manager.reservations') }}">予約情報を確認</a>
    
    <div>
        <a href="{{ route('store_manager.create') }}" class="btn btn-success">店舗を追加</a>
    </div>

    <div>
        <form action="{{ route('store_manager.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">ログアウト</button>
            </form>
    </div>
</div>

@endsection