@extends('layouts.app')

@section('content')
<h2>予約一覧</h2>
<table>
        <tr>
            <th>予約ID</th>
            <th>予約人数</th>
            <th>開始日時</th>
            <th>作成日時</th>
        </tr>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->guest_count }}</td>
            <td>{{ $reservation->start_at }}</td>
            <td>{{ $reservation->created_at }}</td>
        </tr>
        @endforeach
</table>
<a href="{{ route('store_manager.index') }}" class="btn btn-primary">店舗代表者管理ページに戻る</a>
@endsection