@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
  <div class="login-form">
    <div class="login-form__inner">
      <div class="login-form__content">
        <h2 class="login-form__ttl">Login</h2>
        <form class="login-form__form" action="/login" method="post">
          @csrf
          <div class="login-form__group">
            <label class="login-form__label" for="email"></label>
            <i class="fa-solid fa-envelope fa-2x"></i>
            <input class="login-form__input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            <p class="register-form__error-message">
              @error('email')
              {{ $message }}
              @enderror
            </p>
          </div>
          <div class="login-form__group">
            <label class="login-form__label" for="password"></label>
            <i class="fa-solid fa-lock fa-2x"></i>
            <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
            <p>
            @error('password')
            {{ $message }}
            @enderror
            </p>
          </div>
          <div class="register-form__btn">
            <input class="login-form__btn--blue" type="submit" value="ログイン">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection