@extends('layouts.app')

@section('content')
<h1>管理画面：商品一覧</h1>

<a href="{{ route('admin.products.create') }}" class="button">＋ 商品を登録する</a>


@if (session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif

@foreach ($products as $product)
<div class="product-card">
    <h2>{{ $product->title }}</h2>
    <p>¥{{ number_format($product->price) }}</p>
    <p>カテゴリ：{{ $product->category?->name ?? '未設定' }}</p>
    <p>{{ $product->description }}</p>
    <p>出品者: {{ $product->user->name ?? '不明' }}</p>

    {{-- ✅ ログイン済み + 出品者本人だけが編集・削除できる --}}
    @auth
    @if (Auth::id() === $product->user_id)
    <a href="{{ route('admin.products.edit', $product) }}" class="button">編集</a>

    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
    @endif
    @endauth
</div>
@endforeach

<div class="pagination">
    {{ $products->appends(request()->query())->links() }}
</div>

@endsection