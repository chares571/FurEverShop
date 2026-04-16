<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Support\CartManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutPage extends Component
{
    public bool $isBuyNowCheckout = false;

    public string $shipping_name = '';
    public string $shipping_email = '';
    public string $shipping_phone = '';
    public string $shipping_address = '';
    public string $notes = '';
    public string $payment_method = 'cash_on_delivery';

    public function mount(): void
    {
        $user = Auth::user();
        $this->shipping_name = $user->name;
        $this->shipping_email = $user->email;
        $this->isBuyNowCheckout = request()->query('mode') === 'buy-now';
    }

    public function placeOrder()
    {
        $items = $this->checkoutItems();

        abort_if($items->isEmpty(), 403, 'Your cart is empty.');

        $validated = $this->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_email' => ['required', 'email', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_method' => ['required', 'in:cash_on_delivery,e_wallet,bank_transfer'],
        ]);

        $order = DB::transaction(function () use ($items, $validated) {
            $total = 0;
            $products = Product::query()->whereIn('id', $items->pluck('product_id'))->get()->keyBy('id');

            foreach ($items as $item) {
                $product = $products[$item['product_id']] ?? null;

                abort_unless($product && $product->stock >= $item['quantity'], 422, "Insufficient stock for {$item['name']}.");
                $total += $item['quantity'] * (float) $product->price;
            }

            $order = Auth::user()->orders()->create([
                ...$validated,
                'total_price' => $total,
                'status' => Order::STATUS_PENDING,
            ]);

            foreach ($items as $item) {
                $product = $products[$item['product_id']];

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        if ($this->isBuyNowCheckout) {
            CartManager::clearBuyNow();
        } else {
            CartManager::clear();
            $this->dispatch('cart-updated');
        }

        return redirect()
            ->route('orders.index', ['highlight' => $order->id])
            ->with('success', 'Order placed successfully. We are packing it with care.');
    }

    protected function checkoutItems()
    {
        return $this->isBuyNowCheckout
            ? CartManager::buyNowContent()
            : CartManager::content();
    }

    public function render()
    {
        $items = $this->checkoutItems();

        return view('livewire.checkout-page', [
            'items' => $items,
            'subtotal' => $items->sum('subtotal'),
        ])->layout('layouts.storefront', [
            'title' => 'Checkout | FurEver',
        ]);
    }
}
