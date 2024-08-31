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
    
  </body>
</html>