<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>フリマアプリ</title>

    <!-- 外部CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('head')
</head>

<body>
    <!-- ✅ ヘッダー -->
    <header class="main-header">
        {{-- 左：タイトル --}}
        <div class="site-title"><strong>フリマアプリ</strong></div>

        {{-- 中央：検索フォーム --}}
        <form method="GET"
            action="{{ request()->is('admin/*') ? route('admin.products.index') : route('user.products.index') }}"
            class="search-form">

            {{-- カテゴリ検索 --}}
            <select name="category_id" class="search-select">
                <option value="">カテゴリ選択</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            {{-- キーワード検索 --}}
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
            <button type="submit">検索</button>
        </form>

        {{-- 右：ログインナビ --}}
        <nav class="nav-right">
            @auth
            @php $isAdmin = str_starts_with(request()->path(), 'admin'); @endphp

            @if ($isAdmin)
            <a href="{{ route('user.products.index') }}" class="button">一般画面へ</a>
            @else
            <a href="{{ route('admin.products.index') }}" class="button">管理画面へ</a>
            @endif

            {{ Auth::user()->name }} さん |
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="button">ログイン</a>
            <a href="{{ route('register') }}" class="button register-link">会員登録</a>
            @endauth
        </nav>
    </header>

    <!-- ✅ メイン -->
    <main class="main-content">
        @yield('content')
    </main>
</body>

</html>