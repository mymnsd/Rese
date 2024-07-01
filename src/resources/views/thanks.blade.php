@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_register.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="thanks-page">
  <div class="thanks-page__inner">
    <p class="thanks-page__message">会員登録ありがとうございます</p>
      <a class="login-link" href="/login">ログインする</a>
  </div>
</div>
@endsection