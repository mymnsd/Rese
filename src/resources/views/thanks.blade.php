@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
  <div class="thanks-page__inner">
    @if (session('message'))
      <div class="success">
          {{ session('message') }}
      </div>
    @endif
    <div class="thanks-page__content">
      <p class="thanks-page__message">会員登録ありがとうございます</p>
      <div class="thanks-btn">
        <a class="login-link" href="/login">ログインする</a>
      </div>
    </div>
  </div>
</div>
@endsection