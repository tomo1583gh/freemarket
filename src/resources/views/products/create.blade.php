@extends('layouts.app')

@section('content')
    <h1>商品を出品する</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>商品名:</label>
            <input type="text" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label>説明:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label>価格:</label>
            <input type="number" name="price" value="{{ old('price') }}">
        </div>
        <div>
            <label>画像:</label>
            <input type="file" name="image">
        </div>
        <button type="submit">出品</button>
    </form>
@endsection