@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/cancel.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="cancel-page">
  <div class="cancel-page__inner">
    <p class="cancel-page__message">予約をキャンセルしました</p>
      <a class="cancel-page__link" href="/">トップページへ戻る</a>
  </div>
</div>
@endsection