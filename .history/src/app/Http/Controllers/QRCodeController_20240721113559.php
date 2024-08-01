<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;


class QRCodeController extends Controller
{
    public function generate($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $qrCode = QrCode::size(300)->generate((route('reservations.verify', $reservation->id));
        
        // QRコードをビューに渡して表示
        return view('qrcode.show', compact('qrCode', 'reservation'));
    }
}
