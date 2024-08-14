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
        // $qrCodeUrl = route('reservations.verify', ['reservation' => $reservation->id]);

        $qrCode = QrCode::generate(route('reservations.verify', $reservation->id));

        return view('qrcode.show', compact('qrCode', 'reservation'));
    }
}
