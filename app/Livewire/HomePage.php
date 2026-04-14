<?php

namespace App\Livewire;

use App\Models\Product;
use App\Support\FurEver;
use Livewire\Component;

class HomePage extends Component
{
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
