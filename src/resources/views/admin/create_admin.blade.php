@extends('layouts.app')

@section('content')
<h2>管理者登録</h2>
<form action="{{ route('admin.store_admin') }}" method="POST">
    @csrf

    <label for="name">名前:</label>
    <input type="text" name="name" required>

    <label for="email">メールアドレス:</label>
    <input type="email" name="email" required>

    <label for="password">パスワード:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">パスワード確認:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">登録</button>
</form>

<p>登録済みの方は、<a href="{{ route('admin.login') }}">こちら</a>からログインしてください。</p>

@endsection