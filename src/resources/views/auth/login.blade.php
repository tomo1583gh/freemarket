@extends('layouts.app-auth') {{-- ログイン専用レイアウトを継承 --}}

@section('content')
<div class="login-box">
    <h1>ログイン</h1>

    {{-- セッションメッセージ（例：パスワードリセットなど） --}}
    @if (session('status'))
    <div class="status">{{ session('status') }}</div>
    @endif

    {{-- ログインフォーム --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">
        @error('password')
        <div class="error-text">{{ $message }}</div>
        @enderror

        <button type="submit">ログイン</button>
    </form>
</div>
@endsection