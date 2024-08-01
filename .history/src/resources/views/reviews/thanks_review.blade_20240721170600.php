@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_review.css') }}">
@endsection

@section('content')
<div class="thanks_review-page">
  <div class="thanks_review-page__inner">
    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif
    <div class="thanks_review-page__content">
      <p class="thanks_review-page__message">レビュー投稿ありがとうございます</p>
      <div class="thanks_review-btn">
        <a class="login-link" href="/">トップページへ戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection