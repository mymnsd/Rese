@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_manager/login_store_manager.css') }}">
@endsection

@section('content')
@if(session('status'))
<div class="success">
  {{ session('status') }}
</div>
@endif
<div class="container">
  <div class="store-manager__inner">
    <h2 class="content__ttl">StoreManager-Login</h2>
    <form class="form" method="POST" action="{{ route('store_manager.login') }}">
    @csrf
      <div class="form__group">
        <label class="form__label" for="email"></label>
        <i class="fa-solid fa-envelope fa-2x"></i>
        <input class="form__input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" autofocus>
      </div>
      <div class="form__group">
        <label class="form__label" for="password"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
      </div>
      <div class="btn">
        <button class="btn--blue" type="submit">ログイン</button>
      </div>
    </form>
  </div>
</div>
@endsection