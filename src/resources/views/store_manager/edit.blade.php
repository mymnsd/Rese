@extends('layouts.app')

@section('content')
<div class="container">
    <h2>店舗情報の編集</h2>
    <form action="{{ route('store_manager.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $shop->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $shop->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection