<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\CartManager;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetailsPage extends Component
{
    public Product $product;

    public int $quantity = 1;

    protected function redirectToLoginWithMessage(): void
    {
        session()->flash('status', 'Please log in first to add items to your cart.');
        session()->put('url.intended', url()->previous());

        $this->redirect(route('login'));
    }

    public function addToCart(): void
    {
        if (! Auth::check()) {
            $this->redirectToLoginWithMessage();
            return;
        }

        $validated = $this->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$this->product->stock],
        ]);

        CartManager::add($this->product, $validated['quantity']);

        $this->dispatch('cart-updated');
        $this->dispatch('notify', message: 'Added to your cart.', type: 'success');
    }

    public function buyNow(): void
    {
        if (! Auth::check()) {
            $this->redirectToLoginWithMessage();
            return;
        }

        $validated = $this->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$this->product->stock],
        ]);

        // Clear cart and add this product
        CartManager::clear();
        CartManager::add($this->product, $validated['quantity']);

        $this->dispatch('cart-updated');
        $this->redirect(route('checkout.index'));
    }

    public function render()
    {
        return view('livewire.product-details-page', [
            'relatedProducts' => Product::query()
                ->where('category', $this->product->category)
                ->whereKeyNot($this->product->id)
                ->take(4)
                ->get(),
        ])->layout('layouts.storefront', [
            'title' => $this->product->name.' | FurEver',
        ]);
    }
}
