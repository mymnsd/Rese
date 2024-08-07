@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_review.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="inner">
    @if (session('success'))
      <div class="success">
          {{ session('success') }}
      </div>
    @endif
    <div class="thanks-review__content">
      <p class="thanks-review__message">レビュー投稿ありがとうございます</p>
      <div class="thanks-review__link">
        <a class="login-link" href="/">トップページへ戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection