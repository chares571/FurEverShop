<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderManager extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

    public function updateStatus(int $orderId, string $status): void
    {
        abort_unless(in_array($status, Order::statuses(), true), 422);

        Order::query()->findOrFail($orderId)->update([
            'status' => $status,
        ]);

        $this->dispatch('notify', message: 'Order status updated.');
    }

    public function render()
    {
        return view('livewire.admin.order-manager', [
            'orders' => Order::query()
                ->with(['user', 'items.product'])
                ->when($this->statusFilter !== 'all', fn ($query) => $query->where('status', $this->statusFilter))
                ->latest()
                ->paginate(8),
            'statuses' => Order::statuses(),
        ])->layout('layouts.admin', [
            'title' => 'Manage Orders | FurEver',
        ]);
    }
}
