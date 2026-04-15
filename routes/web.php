<?php

use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\OrderManager;
use App\Livewire\Admin\ProductManager;
use App\Livewire\Admin\ProductReviewManager;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\OrderHistoryPage;
use App\Livewire\ProductDetailsPage;
use App\Livewire\ShopPage;
use App\Livewire\ShoppingCartPage;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ShopPage::class)->name('shop.index');
Route::get('/products/{product:slug}', ProductDetailsPage::class)->name('shop.show');
Route::get('/cart', ShoppingCartPage::class)->name('cart.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route(auth()->user()->isAdmin() ? 'admin.dashboard' : 'shop.index');
    })->name('dashboard');

    Route::get('/checkout', CheckoutPage::class)->name('checkout.index');
    Route::get('/orders', OrderHistoryPage::class)->name('orders.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', DashboardPage::class)->name('dashboard');
        Route::get('/products', ProductManager::class)->name('products');
        Route::get('/orders', OrderManager::class)->name('orders');
        Route::get('/reviews', ProductReviewManager::class)->name('reviews');
    });

require __DIR__.'/auth.php';
