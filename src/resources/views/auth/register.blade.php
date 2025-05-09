@extends('layouts.app-auth')

@section('content')
<div class="login-box">
    <h1>会員登録</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">名前</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" >
        @error('name')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" >
        @error('email')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" >
        @error('password')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">パスワード（確認）</label>
        <input id="password_confirmation" type="password" name="password_confirmation" >
        @error('password_confirmation')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <button type="submit">登録</button>
    </form>
</div>
@endsection