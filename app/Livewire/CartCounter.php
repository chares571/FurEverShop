<?php

namespace App\Livewire;

use App\Support\CartManager;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCounter extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->refreshCounter();
    }

    #[On('cart-updated')]
    public function refreshCounter(): void
    {
        $this->count = CartManager::count();
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
