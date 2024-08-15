@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="container">
  @if (session('message'))
      <div class="success" role="alert">
          {{ session('message') }}
      </div>
  @endif
  <div class="sent__inner">
    <h2 class="content__ttl">確認メール再送信</h2>

    <p class="sent-message">確認メールが再送信されました。メールをご確認ください。</p>

    <div class="back-link">
      <a class="link" href="/login">ログインページに戻る</a>
    </div>
  </div>
</div>
@endsection