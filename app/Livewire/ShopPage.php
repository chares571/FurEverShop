<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\CartManager;
use App\Support\FurEver;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $category = 'all';

    #[Url]
    public string $sort = 'latest';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingSort(): void
    {
        $this->resetPage();
    }

    public function addToCart(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);

        if (! $product->inStock()) {
            $this->dispatch('notify', message: 'That item is currently out of stock.', type: 'error');

            return;
        }

        CartManager::add($product);

        $this->dispatch('cart-updated');
        $this->dispatch('notify', message: "{$product->name} added to cart.");
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->category !== 'all', fn ($query) => $query->where('category', $this->category))
            ->when($this->sort === 'price_low', fn ($query) => $query->orderBy('price'))
            ->when($this->sort === 'price_high', fn ($query) => $query->orderByDesc('price'))
            ->when($this->sort === 'name', fn ($query) => $query->orderBy('name'))
            ->when($this->sort === 'latest', fn ($query) => $query->latest())
            ->paginate(9);

        return view('livewire.shop-page', [
            'products' => $products,
            'categories' => FurEver::categories(),
        ])->layout('layouts.storefront', [
            'title' => 'FurEver Shop',
        ]);
    }
}
