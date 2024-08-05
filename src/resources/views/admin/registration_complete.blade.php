@extends('layouts.app')

@section('content')
<div class="container">
    <h2>登録完了</h2>
    <p>管理者が登録されました。</p>
    <a href="{{ route('admin.login') }}">ログインする</a>
</div>
@endsection