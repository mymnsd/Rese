@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/return_payment.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="return__inner">
    <h2 class="content__ttl">決済が完了しました！</h2>
    <p class="message">お支払いが正常に処理されました。<br>ご利用いただきありがとうございます。</p>
    <div class="link">
        <a class="back-link" href="/">トップページへ戻る</a>
    </div>
    </div>
</div>
@endsection