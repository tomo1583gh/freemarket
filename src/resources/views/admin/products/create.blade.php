@extends('layouts.app')

@section('content')
<h1>商品登録（管理者）</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>商品名</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title') <div class="error-message">{{ $message }}</div> @enderror

    <label>説明</label>
    <textarea name="description">{{ old('description') }}</textarea>
    @error('description') <div class="error-message">{{ $message }}</div> @enderror

    <label>価格</label>
    <input type="number" name="price" value="{{ old('price') }}">
    @error('price') <div class="error-message">{{ $message }}</div> @enderror

    <label>画像</label>
    <input type="file" name="image">
    @error('image') <div class="error-message">{{ $message }}</div> @enderror

    <button type="submit">登録</button>
</form>
@endsection