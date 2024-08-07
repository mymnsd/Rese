@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/create_store_manager.css') }}">
@endsection

@section('content')
@if(session('success'))
  <p class="success">{{ session('success') }}</p>
@endif
<div class="container">
  <div class="admin-inner">
    <h2 class="content__ttl">Create-StoreManager</h2>
    <form class="form" action="{{ route('admin.store_store_manager') }}" method="POST">
    @csrf
      <div class="form__group">
        <label class="form__label" for="name"></label>
        <i class="fa-solid fa-user fa-2x"></i>
        <input class="form__input" type="text" name="name" value="{{ old('name') }}" placeholder="name">
      </div>
      <div class="form__group">
        <label class="form__label" for="email"></label>
        <i class="fa-solid fa-envelope fa-2x"></i>
        <input class="form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
      </div>
      <div class="form__group">
        <label class="form__label" for="password"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
      </div>
      <div class="form__group">
        <label class="form__label" for="password_confirmation"></label>
        <i class="fa-solid fa-lock fa-2x"></i>
        <input class="form__input" type="password" name="password_confirmation" value="{{ old('confirmpassword') }}" placeholder="Confirmpassword(確認パスワード)">
      </div>
      <div class="form__group">
        <label class="form__label" for="shop_id"></label>
        <i class="fa-solid fa-shop fa-2x"></i>
        <select class="form__select" name="shop_id" required>
        @foreach($shops as $shop)
          <option class="shops" value="{{ $shop->id }}">{{ $shop->name }}</option>
        @endforeach
        </select>
      </div>
      <div class="btn">
        <button class="btn--blue" type="submit">作成</button>
      </div>
    </form>

    {{-- @if(session('success'))
      <p class="success">{{ session('success') }}</p>
    @endif --}}

    <form class="form" action="{{ route('admin.logout') }}" method="POST">
    @csrf
      <div class="btn">
        <button class="btn--blue" type="submit">ログアウト</button>
      </div>
    </form>
  </div>
</div>
@endsection