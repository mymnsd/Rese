@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login_admin.css') }}">
@endsection

@section('content')
@if(session('message'))
  <p class="message">{{ session('message') }}</p>
@endif
<div class="container">
  <div class="admin-inner">
    <h2 class="content__ttl">Admin-Login</h2>
    <form class="form" method="POST" action="{{ route('admin.login') }}">
    @csrf
      <div class="form__group">
        <label class="form__label" for="email"></label>
        <i class="fa-solid fa-envelope fa-2x"></i>
        <input class="form__input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
      </div>
      <div class="form__group">
        <label class="form__label" for="password"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
      </div>

      <div class="btn">
        <button class="btn--blue" type="submit">ログイン</button>
        </div>
    </form>
  </div>
</div>
@endsection