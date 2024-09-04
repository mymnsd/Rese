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
    <script src="https://kit.fontawesome.com/cf74f62674.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <header class="header">
      <div class="header__inner">
        <div class="header__inner--ttl">
          <div class="header__inner-button">
            @if(Auth::check())
            <a class="header__inner-button--icon"
            href="#modal2">
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            </a>
            @else
            <a class="header__inner-button--icon" href="#modal">
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            </a>
            @endif
          </div>
          <div class="ttl__group">
            <h1 class="site__ttl">
              <a href="/">Rese</a>
            </h1>
          </div>
        </div>
        @yield('sort')
        @yield('nav')
      </div>
    </header>

    <main>
    @yield('content')
    </main>

      {{-- モーダル --}}
    <div class="modal" id="modal">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal__inner">
        <div class="modal__content">
          {{-- モーダルボタン --}}
          <div class="modal__content-button">
            <a class="modal__content-button--icon"
          href="#">
              <span class="modal__content-link--border"></span>
              <span class="modal__content-link--border"></span>
            </a>
          </div>
          <div class="modal-form__group">
            <p class="modal-form__btn">
              <a href="/">Home</a>
            </p>
            <p class="modal-form__btn">
              <a href="/register">Registration</a>
            </p>
            <p class="modal-form__btn">
              <a href="/login">Login</a>
            </p>  
          </div>
        </div>
      </div>
    </div>
    {{-- モーダル2 --}}
    <div class="modal" id="modal2">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal__inner">
        <div class="modal__content">
        {{-- モーダルボタン --}}
          <div class="modal__content-button">
            <a class="modal__content-button--icon"
          href="#">
              <span class="modal__content-link--border"></span>
              <span class="modal__content-link--border"></span>
            </a>
          </div>
          <div class="modal-form__group">
            <p class="modal-form__btn">
              <a class="modal-form__btn" href="/">Home</a>
            </p>
            <form class="form__logout" action="/logout" method="post">
            @csrf
              <button class="logout__btn" type="submit">Logout</button>
            </form>
            <form class="form__mypage" action="/mypage" method="get">
            @csrf
              <button class="mypage__btn" type="submit">Mypage</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if(session('modal') === 'modal2')
    <div class="modal" id="modal2" style="display: none;">
      <a href="#!" class="modal-overlay"></a>
      <div class="modal__inner">
        <div class="modal__content">
          <div class="modal-form__group">
            <a href="/">Home</a>
            <form class="form__logout" action="/logout" method="post">
            @csrf
              <button class="logout__btn" type="submit">Logout</button>
            </form>
            <form class="form__mypage" action="/mypage" method="get">
            @csrf
              <button class="mypage__btn" type="submit">Mypage</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('modal2');
        if (modal) {
          modal.style.display = 'block';
        }
      });
    </script>
    @endif
  </body>
</html>