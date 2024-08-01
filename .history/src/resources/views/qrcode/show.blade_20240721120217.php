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

    
</body>
</html>