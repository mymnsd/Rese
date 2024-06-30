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
  </head>
  <body>
    <header class="header">
      <div class="header__inner">
        <div class="header__inner-button">
          @if(Auth::check())
          <a class="header__inner-button--icon"
          href="#modal2"></a>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
          @else
          <a class="header__inner-button--icon" href="#modal"></a>
          <span class="header__inner-link--border"></span>
          <span class="header__inner-link--border"></span>
          <span class="header__inner-link--border"></span>
          @endif
        </div>
          @yield('title')
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
                <form class="form__logout" action="/logout" method="post">
                @csrf
                  <button class="logout__btn" type="submit">logout</button>
                </form>
                <form class="form__mypage" action="/mypage" method="get">
                  @csrf
                  <button class="mypage__btn" type="submit">Mypage</button>
                </form>
              </div>
          </div>
        </div>
    </div>
    @if(session('modal') === 'modal3')
    <div class="modal" id="modal3" style="display: none;">
      <a href="#!" class="modal-overlay"></a>
        <div class="modal__inner">
          <div class="modal__content">
              <div class="modal-form__group">
                <a href="/">Home</a>
                <form class="form__logout" action="/logout" method="post">
                @csrf
                  <button class="logout__btn" type="submit">logout</button>
                </form>
                <a href="/mypage">Mypage</a>
              </div>
          </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('modal3');
            if (modal) {
                modal.style.display = 'block';
            }
        });
    </script>
    
    @endif
    @yield('content')
    </main>
    
  </body>
</html>