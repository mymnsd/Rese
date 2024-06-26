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
      <form class="header__inner-link">
        @csrf
        <div class="header__inner-button">
          <button class="header__inner-button--icon" type="submit">
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>
            <span class="header__inner-link--border"></span>

          </button>
          
        </div>
        @yield('title')
      </form>
      @yield('nav')
    </div>
  </header>

  <main>
    @yield('content')
  </main>
  
</body>
</html>