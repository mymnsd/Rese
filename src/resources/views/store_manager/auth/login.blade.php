@extends('layouts.app')

@section('content')
<div class="login-container">
        <h2>店舗代表者ログイン</h2>
        <form method="POST" action="{{ route('store-manager.login') }}">
            @csrf
            <div>
                <label for="email">メールアドレス:</label>
                <input type="email" name="email" id="email" required autofocus>
            </div>
            <div>
                <label for="password">パスワード:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection