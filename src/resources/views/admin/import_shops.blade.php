@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')

  @if(session('success'))
    <div class="success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="error ">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('messages'))
    <div class="info">
        <ul class="info-list">
            @foreach(session('messages') as $message)
                <li class="info-item">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
  <div class="import__inner">
    <h2 class="content__ttl">店舗情報CSVインポート</h2>

    <form action="{{ route('admin.import_shops') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label class="form-label" for="csv_file">CSVファイルを選択</label>
          <input type="file" name="csv_file" id="csv_file" class="form-file" required accept=".csv">
      </div>

      <button type="submit" class="import-btn">インポート
      </button>
    </form>

    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
        @csrf
          <button type="submit" class="btn btn-secondary">ログアウト</button>
    </form>

    <div class="back-link--import">
        <a href="{{ route('admin.dashboard') }}" class="link">管理者トップページに戻る</a>
    </div>
  </div>
</div>
@endsection