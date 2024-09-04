@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_review.css') }}">
@endsection

@section('content')
<div class="review-inner">
    <h2 class="content__ttl">{{ $shop->name }} の口コミ一覧</h2>

    @forelse ($otherReviews as $review)
        <div class="review">
          <p>投稿日時: {{ $review->created_at->format('Y-m-d H:i') }}</p>
            <p>{!! ratingStars($review->rating) !!}</p>
            <p>{{ $review->comment }}</p>
            @if ($review->image_path)
              <div class="review-image">
                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Review Image" style="width: 30%; height: auto;">
              </div>
            @endif
            <hr>
        </div>
    @empty
        <p>口コミはありません。</p>
    @endforelse

    <a href="{{ route('shops.detail', $shop->id) }}" class="btn">店舗詳細に戻る</a>
</div>
@endsection