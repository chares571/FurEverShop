<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistoryPage extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.order-history-page', [
            'orders' => Auth::user()
                ->orders()
                ->with(['items.product'])
                ->latest()
                ->paginate(6),
        ])->layout('layouts.storefront', [
            'title' => 'Order History | FurEver',
        ]);
    }
}
