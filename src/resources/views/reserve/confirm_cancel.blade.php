@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comfirm_reserve.css') }}">
@endsection

@section('content')
<div class="cancel-container">
    <h1>予約のキャンセル確認</h1>
    <p>本当に予約をキャンセルしますか？この操作は取り消せません。</p>
    <p>Shop: {{ $reservation->shop->name }}</p>
    <p>Date: {{ $reservation->start_at->format('Y-m-d') }}</p>
    <p>Time: {{ $reservation->start_at->format('H:i') }}</p>
    <p>Number: {{ $reservation->guest_count }}人</p>

    <form method="POST" action="{{ route('reserve.confirmCancel', ['id' => $reservation->id]) }}">
        @csrf
        <button type="submit" class="btn btn-danger">キャンセルを確定</button>
        <a href="/mypage" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection