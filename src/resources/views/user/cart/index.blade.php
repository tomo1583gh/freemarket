@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<h1 class="cart-title">ショッピングカート</h1>

@if (session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif

<div class="cart-container">
    @forelse ($cartItems as $item)
    <div class="cart-item">
        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="商品画像">

        <div class="cart-item-details">
            <div class="cart-item-title">{{ $item->product->title }}</div>
            <div class="cart-item-price">¥{{ number_format($item->product->price) }}</div>
            <div class="cart-item-desc">{{ $item->product->description }}</div>
        </div>

        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="cart-item-remove">削除</button>
        </form>
    </div>
    @empty
    <p>カートに商品がありません。</p>
    @endforelse

    @if (count($cartItems) > 0)
    <div class="cart-summary">
        合計金額：¥{{ number_format($totalPrice) }}
        <br>
        <a href="{{ route('checkout.index') }}" class="checkout-button">購入手続きへ</a>
    </div>
    @endif
</div>
@endsection