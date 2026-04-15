<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistoryPage extends Component
{
    use WithPagination;

    public function cancelOrder(int $orderId): void
    {
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow cancellation of pending or processing orders
        if (!in_array($order->status, [Order::STATUS_PENDING, Order::STATUS_PROCESSING])) {
            $this->dispatch('notify', message: 'This order cannot be cancelled.', type: 'error');
            return;
        }

        // Restore stock for all items in the order
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        // Update order status
        $order->update(['status' => Order::STATUS_CANCELLED]);

        $this->dispatch('notify', message: 'Order cancelled successfully. Stock has been restored.');
    }

    public function render()
    {
        $reviewedProductIds = Review::query()
            ->where('user_id', Auth::id())
            ->pluck('product_id')
            ->all();

        return view('livewire.order-history-page', [
            'orders' => Auth::user()
                ->orders()
                ->with(['items.product'])
                ->latest()
                ->paginate(6),
            'reviewedProductIds' => array_flip($reviewedProductIds),
        ])->layout('layouts.storefront', [
            'title' => 'Order History | FurEver',
        ]);
    }
}
