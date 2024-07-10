@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="edit-page">
  <div class="edit-page__inner">
    <div class="edit-page__content">
      <p class="edit-page__message">予約を変更しました</p>
      <div class="edit-page__btn">
        <a class="edit-page__link" href="/">トップページへ戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection