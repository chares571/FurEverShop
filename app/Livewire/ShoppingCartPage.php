<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\CartManager;
use Livewire\Component;

class ShoppingCartPage extends Component
{
    public function increase(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);
        $current = CartManager::content()->firstWhere('product_id', $productId);

        if (! $current) {
            return;
        }

        CartManager::update($product, $current['quantity'] + 1);
        $this->dispatch('cart-updated');
    }

    public function decrease(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);
        $current = CartManager::content()->firstWhere('product_id', $productId);

        if (! $current) {
            return;
        }

        CartManager::update($product, $current['quantity'] - 1);
        $this->dispatch('cart-updated');
    }

    public function remove(int $productId): void
    {
        CartManager::remove($productId);
        $this->dispatch('cart-updated');
        $this->dispatch('notify', message: 'Item removed from cart.');
    }

    public function render()
    {
        return view('livewire.shopping-cart-page', [
            'items' => CartManager::content(),
            'subtotal' => CartManager::subtotal(),
        ])->layout('layouts.storefront', [
            'title' => 'Your Cart | FurEver',
        ]);
    }
}
