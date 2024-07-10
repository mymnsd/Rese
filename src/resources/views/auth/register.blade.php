@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('title')
<div class="ttl__group">
  <h1 class="site__ttl">
    <a href="/">Rese</a>
  </h1>
</div>
@endsection

@section('content')
<div class="register-form">
  <div class="register-form__inner">
    <div class="register-form__content">
      <h2 class="register-form__ttl">Registration</h2>
      <form class="register-form__form" action="/register" method="post">
        @csrf
        <div class="register-form__group">
          <label class="register-form__label" for="name"></label>
          <i class="fa-solid fa-user fa-2x"></i>
          <input class="register-form__input" type="text" name="name" id="name" placeholder="Username">
          <p class="register-form__error-message">
            @error('name')
            {{ $message }}
            @enderror
          </p>
        </div>
        <div class="register-form__group">
          <label class="register-form__label" for="email"></label>
          <i class="fa-solid fa-envelope fa-2x"></i>
          <input class="register-form__input" type="mail" name="email" id="email" placeholder="Email">
          <p class="register-form__error-message">
            @error('email')
            {{ $message }}
            @enderror
          </p>
        </div>
        <div class="register-form__group">
          <label class="register-form__label" for="password"></label>
          <i class="fa-solid fa-lock fa-2x"></i>
          <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
          <p class="register-form__error-message">
            @error('password')
            {{ $message }}
            @enderror
          </p>
        </div>
        <div class="register-form__btn">
          <input class="register-form__btn--blue" type="submit" value="登録">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection