@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="import__inner">
    <h2 class="content__ttl">店舗情報CSVインポート</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.import_shops') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label class="form-label" for="csv_file">CSVファイルを選択</label>
          <input type="file" name="csv_file" id="csv_file" class="form-file" required accept=".csv">
      </div>

      <button type="submit" class="import-btn">インポート
      </button>
    </form>
    <div class="back-link--import">
        <a href="{{ route('admin.dashboard') }}" class="link">トップページに戻る</a>
    </div>
  </div>
</div>
@endsection