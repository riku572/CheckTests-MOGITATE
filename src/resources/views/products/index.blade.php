@extends('layouts.main')

@section('title', '商品一覧')

@section('content')
    @if (!empty($sortLabel))
        <div class="tag">
            並び替え: {{ $sortLabel ?? '' }}
            <a href="{{ route('products.search', ['search' => request('search')]) }}">×</a>
        </div>
    @endif

    <div class="grid">
        @forelse ($products as $product)
            <div class="card">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                <div class="card-title">{{ $product->name }}</div>
                <div class="card-text">¥{{ number_format($product->price) }}</div>
            </div>
        @empty
            <p>該当する商品は見つかりませんでした。</p>
        @endforelse
    </div>

    <div style="margin-top: 1rem;">
        {{ $products->links() }}
    </div>
@endsection
