<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">管理画面</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">管理画面トップ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shops.index') }}">店舗管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reservation') }}">予約管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop_manager.register.form') }}">店舗代表者登録</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>