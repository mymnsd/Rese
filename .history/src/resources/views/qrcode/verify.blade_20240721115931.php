<!DOCTYPE html>
<html>
<head>
    <title>予約の確認</title>
</head>
<body>
    <h1>予約の確認</h1>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>店舗ID: {{ $reservation->shop_id }}</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>ユーザーID: {{ $reservation->user_id }}</p>
    <p>予約者名: {{ $reservation->user->name }}</p> 
    <p>数: {{ $reservation->guest_count }}</p>
    <p>予約日時: {{ $reservation->start_at }}</p>
</body>
</html>