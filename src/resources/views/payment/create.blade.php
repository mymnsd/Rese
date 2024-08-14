@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/create_payment.css') }}">
@endsection

@section('content')
<div class="container">
  @if (session('flash_alert'))
    <div class="danger">{{ session('flash_alert') }}</div>
  @elseif(session('status'))
    <div class="success">
      {{ session('status') }}
    </div>
  @endif

  <div class="container">
    <div class="payment__inner">
      <h2 class="content__ttl">Payment for {{ $shop->name }}</h2>
      <div class="card-body">
        <form class="form" id="form" action="{{ route('payment.store') }}" method="POST">
        @csrf
          <input type="hidden" name="shop_id" value="{{ $shop->id }}">
          <input type="hidden" name="guest_count" value="{{ $guest_count }}">
          <input type="hidden" name="price" value="{{ $price }}">

          <div class="card-item">
            <label class="form__label">人数:{{ $guest_count }}人</label>
            <label class="form__label">合計金額:{{ number_format($price) }} 円</label>
          </div>

          <div class="card-item">
            <label class="form__label" for="card_number">カード番号</label>
            <div id="card-number" class="form-control"></div>
          </div>

          <div class="card-item">
            <label class="form__label" for="card_expiry">有効期限</label>
            <div id="card-expiry" class="form-control"></div>
          </div>

          <div class="card-item">
            <label class="form__label" for="card-cvc">セキュリティコード</label>
            <div id="card-cvc" class="form-control"></div>
          </div>

          <div id="card-errors" class="text-danger"></div>

          <button class="btn">支払い</button>
        </form>
        <div class="link">
        <a class="back-link" href="/mypage">マイページへ戻る</a>
      </div>
      </div>
    </div>
  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
// Stripeの設定
const stripe_public_key = "{{ config('stripe.stripe_public_key') }}";
const stripe = Stripe(stripe_public_key);
const elements = stripe.elements();

    // カード番号の作成と表示
const cardNumber = elements.create('cardNumber');
cardNumber.mount('#card-number');
cardNumber.on('change', function(event) {
const displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// 有効期限の作成と表示
const cardExpiry = elements.create('cardExpiry');
cardExpiry.mount('#card-expiry');
cardExpiry.on('change', function(event) {
const displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// セキュリティコードの作成と表示
const cardCvc = elements.create('cardCvc');
cardCvc.mount('#card-cvc');
cardCvc.on('change', function(event) {
const displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// フォームの送信処理
const form = document.getElementById('form');
form.addEventListener('submit', function(event) {
event.preventDefault();
stripe.createPaymentMethod({
    type: 'card',
    card: cardNumber,
  }).then(function(result) {
    if (result.error) {
    // エラーメッセージの表示
      const errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
    // 支払い処理の呼び出し
      stripeTokenHandler(result.paymentMethod.id);
    }
  });
});

// トークン処理とフォームの送信
function stripeTokenHandler(paymentMethodId) {
  const form = document.getElementById('form');
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'payment_method_id');
  hiddenInput.setAttribute('value', paymentMethodId);
  form.appendChild(hiddenInput);form.submit();
}
</script>
@endsection