<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
</head>
<body>
    <h1>予約確認用QRコード</h1>
    <div>
        {!! $qrCode !!}
    </div>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>来店日時: {{ $reservation->start_at }}</p>

    <p>予約ID: {{ $reservation->id }}</p>
    <p>店舗ID: {{ $reservation->shop_id }}</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>お客様ID: {{ $reservation->user_id }}</p>
    <p>お名前: {{ $reservation->user->name }}様</p> 
    <p>予約人数: {{ $reservation->guest_count }}人</p>
    <p>予約日時: {{ $reservation->start_at }}</p>
</body>
</html>