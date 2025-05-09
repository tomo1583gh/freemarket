@extends('layouts.app')

@section('content')
<h1>商品一覧</h1>

@if (session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif

@foreach ($products as $product)
<div class="product-card">
    <h2>{{ $product->title }}</h2>
    <p>¥{{ $product->price }}</p>
    <p>カテゴリ：{{ $product->category?->name ?? '未設定' }}</p>
    <p>{{ $product->description }}</p>
    @if ($product->image_path)
    <img src="{{ asset('storage/' . $product->image_path) }}" width="150">
    @endif
    <p>出品者: {{ $product->user->name ?? '不明' }}</p>
</div>
@endforeach

<div class="pagination">
    {{ $products->appends(request()->query())->links() }}
</div>

@endsection