<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\CartManager;
use App\Support\FurEver;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomePage extends Component
{
    public function buyNow(int $productId): void
    {
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $product = Product::query()->findOrFail($productId);

        if (! $product->inStock()) {
            $this->dispatch('notify', message: 'That item is currently out of stock.', type: 'error');
            return;
        }

        // Clear cart and add this product
        CartManager::clear();
        CartManager::add($product);

        $this->dispatch('cart-updated');
        $this->redirect(route('checkout.index'));
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
