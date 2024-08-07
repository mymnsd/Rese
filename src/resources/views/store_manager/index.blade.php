@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/index_store_manager.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="index__inner">
    <h2 class="content__ttl">店舗情報</h2>

    @if (session('success'))
    <div class="success">
      {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="error">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @foreach ($managedShops as $shop)
    <p>店舗代表者名: {{ $shop->manager_name }}</p>
    <div class="shop">
      <p class="shop-item">店舗名: {{ $shop->name }}</p>
      <p class="shop-item">エリア: {{ $shop->area->name }}</p>
      <p class="shop-item">ジャンル: {{ $shop->genre->name }}</p>
      <p class="shop-item">説明: {{ $shop->description }}</p>
      <div class="shop-img">
        <img class="img" src="{{ $shop->image_url }}" alt="店舗画像">
      </div>
      <div class="updata-link">
        <a class="link" href="{{ route('store_manager.edit', ['shopId' => $shop->id]) }}" class="btn">店舗内容を更新</a>
      </div>

      <form class="form" action="{{ route('shops.destroy', $shop->id) }}" method="POST">
      @csrf
      @method('DELETE')
        <button class="btn" type="submit">削除</button>
      </form>
    </div>
    @endforeach

    <div class="flex">
    @foreach ($addedShops as $shop)
      <div class="shop">
        <p class="shop-item">店舗名: {{ $shop->name }}</p>
        <p class="shop-item">エリア: {{ $shop->area->name }}</p>
        <p class="shop-item">ジャンル: {{ $shop->genre->name }}</p>
        <p class="shop-item">説明: {{ $shop->description }}</p>
        <div class="shop-img">
          <img src="{{ $shop->image_url }}" alt="店舗画像">
        </div>
        <div class="updata-link">
          <a class="link" href="{{ route('store_manager.edit', ['shopId' => $shop->id]) }}" class="btn btn-success">店舗内容を更新</a>
        </div>

        <form class="form" action="{{ route('shops.destroy', $shop->id) }}" method="POST">
        @csrf
        @method('DELETE')
          <button class="btn" type="submit">削除</button>
        </form>
      </div>
      @endforeach
    </div>

    <div class="create-link">
      <a class="link" href="{{ route('store_manager.create') }}" class="btn btn-success">店舗を追加</a>
    </div>

    <div class="reservation-area">
      <h2 class="content__ttl">予約一覧</h2>
      <div class="reservation-link">
        <a class="link" href="{{ route('store_manager.reservations') }}">予約情報を確認</a>
      </div>
    </div>

    <div class="logout">
      <form class="form" action="{{ route('store_manager.logout') }}" method="POST" style="display: inline;">
      @csrf
        <button type="submit" class="btn">ログアウト</button>
      </form>
    </div>
    
  </div>
</div>

@endsection