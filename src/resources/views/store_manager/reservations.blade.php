@extends('layouts.app')

@section('content')
<h1>予約一覧</h1>
<table>
    <thead>
        <tr>
            <th>予約ID</th>
            <th>予約人数</th>
            <th>開始日時</th>
            <th>作成日時</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->guest_count }}</td>
            <td>{{ $reservation->start_at }}</td>
            <td>{{ $reservation->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection