@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-page">
  <div class="done-page__inner">
    <div class="done-page__content">
      <p class="done-page__message">ご予約ありがとうございます</p>
      <div class="done-btn">
        <a class="done-page__link" href="/">戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection