@extends('layouts.admin')

@section('content')
    <h1>予約一覧</h1>
    @foreach ($reservations as $reservation)
        <div>
            <p>予約ID: {{ $reservation->id }}</p>
            <p>顧客名: {{ $reservation->user->name }}</p>
            <p>予約日時: {{ $reservation->reservation_date }}</p>
            <p>人数: {{ $reservation->number_of_people }}</p>
        </div>
    @endforeach
@endsection