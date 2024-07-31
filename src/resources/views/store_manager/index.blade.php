@extends('layouts.app')

@section('content')
<h1>店舗情報</h1>
<form action="{{ route('store_manager.update') }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">店舗名:</label>
    <input type="text" name="name" value="{{ $shop->name }}" required>

    <label for="description">説明:</label>
    <textarea name="description">{{ $shop->description }}</textarea>

    <button type="submit">更新</button>
</form>

<h2>予約一覧</h2>
<a href="{{ route('store_manager.reservations') }}">予約情報を確認</a>
@endsection