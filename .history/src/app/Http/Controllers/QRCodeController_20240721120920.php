<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;


class QRCodeController extends Controller
{
    public function generate($reservationId)
    {
        // $reservation = Reservation::findOrFail($reservationId);
        // $qrCode = QrCode::size(300)->generate(route('reservations.verify', $reservation->id));
        
        $reservation = Reservation::with(['shop', 'user'])->findOrFail($reservationId);
        $qrCodeData = json_encode([
            'reservation_id' => $reservation->id,
            'shop_name' => $reservation->shop->name,
            'user_name' => $reservation->user->name,
            'guest_count' => $reservation->guest_count,
            'start_at' => $reservation->start_at,
        ]);
        $qrCode = QrCode::size(300)->generate($qrCodeData);
        
        // QRコードをビューに渡して表示
        return view('qrcode.show', compact('qrCode', 'reservation'));
    }
}
