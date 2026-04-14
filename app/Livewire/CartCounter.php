<?php

namespace App\Livewire;

use App\Support\CartManager;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCounter extends Component
{
    #[On('cart-updated')]
    public function refreshCounter(): void
    {
        //
    }

    public function render()
    {
        return view('livewire.cart-counter', [
            'count' => CartManager::count(),
        ]);
    }
}
