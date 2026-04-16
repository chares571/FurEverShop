<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\CartManager;
use App\Support\FurEver;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomePage extends Component
{
    protected function redirectToLoginWithMessage(): void
    {
        session()->flash('status', 'Please log in first to add items to your cart.');
        session()->put('url.intended', url()->previous());

        $this->redirect(route('login'));
    }

    public function addToCart(int $productId): void
    {
        if (! Auth::check()) {
            $this->redirectToLoginWithMessage();
            return;
        }

        $product = Product::query()->findOrFail($productId);

        if (! $product->inStock()) {
            $this->js("\$window.dispatchEvent(new CustomEvent('flash-message', { detail: { message: 'That item is currently out of stock.', type: 'error' } }))");
            return;
        }

        CartManager::add($product);

        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated')->to(CartCounter::class);
        $this->js("\$window.dispatchEvent(new CustomEvent('flash-message', { detail: { message: 'Added to your cart.', type: 'success' } }))");
    }

    public function buyNow(int $productId): void
    {
        if (! Auth::check()) {
            $this->redirectToLoginWithMessage();
            return;
        }

        $product = Product::query()->findOrFail($productId);

        if (! $product->inStock()) {
            $this->js("\$window.dispatchEvent(new CustomEvent('flash-message', { detail: { message: 'That item is currently out of stock.', type: 'error' } }))");
            return;
        }

        CartManager::startBuyNow($product);

        $this->redirect(route('checkout.index', ['mode' => 'buy-now']));
    }

    public function render()
    {
        return view('livewire.home-page', [
            'featuredProducts' => Product::query()
                ->where('is_featured', true)
                ->latest()
                ->take(6)
                ->get(),
            'categories' => FurEver::categories(),
            'stats' => [
                'products' => Product::count(),
                'happyOrders' => \App\Models\Order::count(),
                'inStock' => Product::where('stock', '>', 0)->count(),
            ],
        ])->layout('layouts.storefront', [
            'title' => 'FurEver | Pet Essentials with Heart',
        ]);
    }
}
