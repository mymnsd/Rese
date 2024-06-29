@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
<h1 class="header__ttl">Rese</h1>
@endsection

@section('content')
  <div class="login-form">
    <div class="login-form__inner">
      <h2 class="login-form__heading content__heading">Login</h2>
      <form class="login-form__form" action="/login" method="post">
        @csrf
        <div class="login-form__group">
          <label class="login-form__label" for="email"></label>
          <input class="login-form__input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
          <p class="register-form__error-message">
            @error('email')
            {{ $message }}
            @enderror
          </p>
        </div>
        <div class="login-form__group">
          <label class="login-form__label" for="password"></label>
          <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
          <p>
          @error('password')
          {{ $message }}
          @enderror
          </p>
        </div>
        <input class="login-form__btn btn" type="submit" value="ログイン">
      </form>
    </div>
  </div>
@endsection