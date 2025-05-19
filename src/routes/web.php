<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductManageController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ✅ トップページを商品一覧（index）にする
Route::get('/', [ProductController::class, 'index'])->name('user.products.index');

// ✅ 商品用のルート（出品・保存・編集など一括定義）
Route::resource('products', ProductController::class)->except(['index'])
    ->names('user.products'); //名前空間を変更

// ✅ ログインしているユーザーのダッシュボード（オプション）
Route::get('/dashboard', function () {
    return redirect()->route('user.products.index');
})->middleware(['auth'])->name('dashboard');

// 購入手続き（仮）
Route::middleware('auth')->group(function () {
    Route::get('/checkout', function () {
        return view('user.checkout.index');
    })->name('checkout.index');
});

// ✅ カート機能（ログイン後のみ）
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
});

// ✅ Laravel Breeze の認証ルート（ログイン/ログアウト/登録）
require __DIR__ . '/auth.php';

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('products/create', [ProductManageController::class, 'create'])->name('products.create');
    Route::post('products', [ProductManageController::class, 'store'])->name('products.store');
    Route::resource('products', ProductManageController::class)->except(['show']);
});

// ✅ 認証関連（Laravel Breeze）
require __DIR__ . '/auth.php';
