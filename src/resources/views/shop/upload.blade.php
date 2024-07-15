{{-- @extends('layouts.app') --}}

{{-- @section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('shop.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- その他の入力フィールド -->
        <div>
            <label for="image">店舗画像</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit">保存</button>
    </form>
    
</body>
</html>