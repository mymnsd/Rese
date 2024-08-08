@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/notification.css') }}">
@endsection

@section('content')
<div class="container">
  @if (session('success'))
  <div class="success">
      {{ session('success') }}
  </div>
  @endif
  <div class="notification__inner">
    <h2 class="content__ttl">お知らせメールの送信</h2>
    <form class="form" action="{{ route('store_manager.sendNotification') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="subject">件名</label>
            <input class="form-input" type="text" name="subject" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="message">本文</label>
            <textarea class="form-control"  name="message"required></textarea>
        </div>
        <button class="btn" type="submit">送信</button>
        <div class="back-link">
          <a class="link" href="{{ route('store_manager.index') }}" >店舗情報ページに戻る</a>
        </div>
    </form>
  </div>
</div>
@endsection