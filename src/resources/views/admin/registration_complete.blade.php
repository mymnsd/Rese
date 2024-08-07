@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/registration_complete.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="complete__inner">
    <h2 class="content__ttl">登録完了</h2>
    <p class="complete-message">管理者が登録されました。</p>

    <div class="login-link">
      <a class="link" href="{{ route('admin.login') }}">ログインする</a>
    </div>
  </div>
</div>
@endsection