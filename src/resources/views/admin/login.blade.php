@extends('layouts.app')

@section('content')
<div class="container">
        <h2>管理者ログイン</h2>

        @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
@endsection