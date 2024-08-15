@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/index_store_manager.css') }}">
@endsection

@section('content')

<div class="container">
  <div class="container">
  @if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif
  <div class="index__inner">
    <h2 class="content__ttl">管理している店舗</h2>
    <div class="flex">
      @foreach($allShops as $shop)
        <div class="shop-item">
          <h3>{{ $shop->name }}</h3>
          <div class="shop-img">
            <img class="img" src="{{ $shop->image_url }}" alt="店舗画像">
          </div>
          <p>エリア: {{ $shop->area->name }}</p>
          <p>ジャンル: {{ $shop->genre->name }}</p>
          <p>説明: {{ $shop->description }}</p>
          <p>価格: {{ $shop->price }}円</p>
          <a href="{{ route('store_manager.edit', $shop->id) }}" class="btn">店舗情報を編集する</a>
          <form action="{{ route('shops.destroy', $shop->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">店舗を削除する</button>
          </form>
        </div>
      @endforeach
    </div>
        <div class="create-link">
          <a class="link" href="{{ route('store_manager.create') }}" class="btn btn-success">店舗を追加</a>
        </div>
    
    {{-- 予約一覧リンク --}}
    <div class="reservation-area">
      <h2 class="content__ttl">予約一覧</h2>
      <div class="reservation-link">
        <a class="link" href="{{ route('store_manager.reservations') }}">予約情報を確認</a>
      </div>
    </div>

    <!-- お知らせメール送信リンク -->
    <div class="notification-area">
      <h2 class="content__ttl">お知らせメール</h2>
      <div class="notification-link">
        <a class="link" href="{{ route('store_manager.notification') }}">お知らせメールを送信</a>
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