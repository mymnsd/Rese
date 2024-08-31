@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login_admin.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="admin-inner">
    <h2 class="content__ttl">Admin-TopPage</h2>
    <div class="dashboard-links">
        <a href="{{ route('admin.create_store_manager') }}" class="link-left">店舗代表者作成ページ</a>
        <a href="{{ route('admin.index') }}" class="link-right">口コミ削除ページ</a>
    </div>
  </div>
</div>
@endsection