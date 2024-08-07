@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="email__inner">
    <div class="card-area">
      <div class="card">
        <div class="card-header">{{ __('メールアドレスをご確認ください') }}
        </div>

        <div class="card-body">
          @if (session('message'))
            <div class="success" role="alert">
            {{ session('message') }}
            </div>
          @endif

          <p class="card-item">{{ __('メールをご確認ください。') }}
          </p>
          <p class="card-item">{{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }}
          </p>

          <form class="form" method="POST" action="{{ route('verification.resend') }}">
          @csrf
            <button class="btn" type="submit">{{ __('確認メールを再送信する') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection