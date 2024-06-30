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
    <h2 class="register-form__heading content__heading">Registration</h2>
    <form class="register-form__form" action="/register" method="post">
      @csrf
      <div class="register-form__group">
        <label class="register-form__label" for="name"></label>
        <input class="register-form__input" type="text" name="name" id="name" placeholder="Username">
        <p class="register-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="email"></label>
        <input class="register-form__input" type="mail" name="email" id="email" placeholder="Email">
        <p class="register-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="register-form__group">
        <label class="register-form__label" for="password"></label>
        <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
        <p class="register-form__error-message">
          @error('password')
          {{ $message }}
          @enderror
        </p>
      </div>
      <input class="register-form__btn btn" type="submit" value="登録">
    </form>
  </div>
</div>
@endsection