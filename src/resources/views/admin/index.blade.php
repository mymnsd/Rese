@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_review.css') }}">
@endsection

@section('content')
<div class="container">
  @if (session('success'))
    <div class="success">
      {{ session('success') }}
    </div>
  @endif
  <div class="review__inner review">
    <h2 class="content__ttl">口コミ管理</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>ユーザー名</th>
          <th>店舗名</th>
          <th>評価</th>
          <th>コメント</th>
          <th>削除</th>
        </tr>
      </thead>
    <tbody>
      @foreach ($reviews as $review)
        <tr>
          <td>{{ $review->id }}</td>
          <td>{{ $review->user->name }}</td>
          <td>{{ $review->shop->name }}</td>
          <td>{{ $review->rating }}</td>
          <td>{{ $review->comment }}</td>
          <td>
            <form action="{{ route('admin.destroy', $review->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
              @csrf
                @method('DELETE')
                  <button type="submit" class="btn btn-danger">削除</button>
              </form>
          </td>
        </tr>
      @endforeach
    </tbody>
    </table>

    <div class="btn-area">
        <a href="{{ route('admin.dashboard') }}" class="back-link">管理者トップページに戻る</a>

        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-secondary">ログアウト</button>
        </form>
    </div>
  </div>
</div>
@endsection