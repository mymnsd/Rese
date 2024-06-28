<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__inner-button">
        <a class="header__inner-button--icon" href="#modal"></a>
      
      {{-- <form class="header__inner-link" action="/auth/register" method="get">
        @csrf
        <div class="header__inner-button">
          <button class="header__inner-button--icon" type="submit"> --}}
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
          {{-- </button> --}}
      </div>
        @yield('title')
      {{-- </form> --}}
      @yield('nav')
    </div>
  </header>

  <main>
    <div class="modal" id="modal">
  <a href="#!" class="modal-overlay"></a>
    <div class="modal__inner">
      <div class="modal__content">
          <div class="modal-form__group">
            <a href="/">Home</a>
            <a href="/register">Registration</a>
            <a href="/login">Login</a>
          </div>
      </div>
    </div>
</div>
<div class="modal" id="modal2">
  <a href="#!" class="modal-overlay"></a>
    <div class="modal__inner">
      <div class="modal__content">
          <div class="modal-form__group">
            <a href="/">Home</a>
            <a href="/logout">Logout</a>
            <a href="/mypage">Mypage</a>
          </div>
      </div>
    </div>
</div>
    @yield('content')
  </main>
  
</body>
</html>