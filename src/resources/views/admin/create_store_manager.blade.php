@extends('layouts.app')

@section('content')
<h2>店舗代表者作成</h2>
<form action="{{ route('admin.store_store_manager') }}" method="POST">
    @csrf

    <label for="name">名前:</label>
    <input type="text" name="name" required>

    <label for="email">メールアドレス:</label>
    <input type="email" name="email" required>

    <label for="password">パスワード:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">パスワード確認:</label>
    <input type="password" name="password_confirmation" required>

    <label for="shop_id">店舗:</label>
    <select name="shop_id" required>
        @foreach($shops as $shop)
        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
        @endforeach
    </select>

    <button type="submit">作成</button>
</form>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@endsection