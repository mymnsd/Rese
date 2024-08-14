@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create_admin.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="admin-inner">
    <h2 class="content__ttl">Admin-Registration</h2>
    <form class="form" action="{{ route('admin.store_admin') }}" method="POST">
    @csrf
      <div class="form__group">
        <label class="form__label" for="name"></label>
        <i class="fa-solid fa-user fa-2x"></i>
        <input class="form__input" type="text" name="name" value="{{ old('name') }}" placeholder="name">
      </div>
      <p class="register-form__error-message">
          @error('name')
          {{ $message }}
          @enderror
      </p>

      <div class="form__group">
        <label class="form__label" for="email"></label>
        <i class="fa-solid fa-envelope fa-2x"></i>
        <input class="form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
      </div>
      <p class="register-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
      </p>

      <div class="form__group">
        <label class="form__label" for="password"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
      </div>
      <p class="register-form__error-message">
          @error('password')
          {{ $message }}
          @enderror
      </p>

      <div class="form__group">
        <label class="form__label" for="password_confirmation"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmpassword(確認パスワード)">
      </div>
      <p class="register-form__error-message">
          @error('password_confirmation')
          {{ $message }}
          @enderror
      </p>

      <div class="btn">
        <button class="btn--blue" type="submit">登録</button>
      </div>

    </form>

    <p class="login">登録済みの方は、
      <a class="login-link" href="{{ route('admin.login') }}">こちら</a>からログインしてください。
    </p>
  </div>
</div>
@endsection